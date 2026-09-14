@extends('admin.layouts.app')
@section('title', 'Journal · Content Studio')
@section('breadcrumb', 'Journal')
@section('content')
    <section class="flex flex-col items-start justify-between gap-6 mb-7 lg:flex-row">
        <div><span class="text-[13px] font-semibold tracking-[0.09em] text-[#526A5A]">JOURNAL & KNOWLEDGE ARCHIVE</span>
            <h1>Journal</h1>
            <p>Write, organize, and publish clinical knowledge, reflections, and stories.</p>
        </div><a
            class="inline-flex h-11 cursor-pointer items-center justify-center gap-2 rounded-md border border-transparent px-3.5 text-sm font-medium no-underline transition bg-[#526A5A] text-white hover:bg-[#293C32]"
            href="{{ route('admin.posts.create') }}"><x-icon name="plus" /> New Content</a>
    </section>
    <div class="mb-4 rounded-lg border border-[#EBEFEA] bg-white p-2.5">
        <form
            class="flex flex-wrap items-center gap-2 [&_input]:rounded-md [&_input]:border [&_input]:border-[#DDE2DF] [&_input]:bg-white [&_input]:px-2.5 [&_input]:py-2 [&_input]:text-sm [&_input]:outline-none [&_select]:rounded-md [&_select]:border [&_select]:border-[#DDE2DF] [&_select]:bg-white [&_select]:px-2.5 [&_select]:py-2 [&_select]:text-sm [&_select]:outline-none [&_input:focus]:border-[#526A5A] [&_select:focus]:border-[#526A5A]">
            <input class="min-w-[220px] sm:min-w-[280px]" name="search" value="{{ request('search') }}"
                placeholder="Search journal…"><select name="status">
                <option value="all">All statuses</option>
                @foreach (['draft', 'scheduled', 'published', 'archived'] as $v)
                    <option value="{{ $v }}" @selected(request('status') === $v)>{{ ucfirst($v) }}</option>
                @endforeach
            </select>
            <select name="type">
                <option value="all">All formats</option>
                @foreach (['article', 'clinical_case', 'quick_note', 'story'] as $v)
                    <option value="{{ $v }}" @selected(request('type') === $v)>
                        {{ ucwords(str_replace('_', ' ', $v)) }}
                    </option>
                @endforeach
            </select>
            <select name="category_id">
                <option value="">All categories</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected((string) request('category_id') === (string) $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
            <button
                class="inline-flex h-11 cursor-pointer items-center justify-center gap-2 rounded-md border border-transparent px-3.5 text-sm font-medium no-underline transition border-[#DDE2DF] bg-white text-[#293C32] hover:bg-[#F7F5EF]">Filter</button>
        </form>
    </div>
    <div class="overflow-hidden rounded-lg border border-[#EBEFEA] bg-white">
        <div
            class="hidden grid-cols-[minmax(260px,1.6fr)_.8fr_.6fr_.7fr_1fr] items-center gap-[15px] bg-[#F0F5F0] px-4 py-3 text-[12px] uppercase tracking-[0.06em] text-[#545F57] md:grid">
            <span>Title</span><span>Category</span><span>Status</span><span>Updated</span><span></span>
        </div>
        @forelse($posts as $post)
            <div
                class="grid grid-cols-1 items-center gap-2 border-t border-[#EBEFEA] px-4 py-3 text-sm md:grid-cols-[minmax(260px,1.6fr)_.8fr_.6fr_.7fr_1fr] md:gap-[15px] [&_small]:mt-1 [&_small]:block [&_small]:text-[#545F57]">
                <div
                    class="flex items-center gap-2.5 [&_img]:h-11 [&_img]:w-11 [&_img]:rounded [&_img]:object-cover [&_a]:block [&_a]:font-semibold [&_a]:text-[#181D1A] [&_a]:no-underline [&_small]:mt-1 [&_small]:block [&_small]:text-[#545F57]">
                    @if ($post->featuredMedia)
                    <img src="{{ $post->featuredMedia->url }}" alt="">@else<div
                            class="grid h-11 w-11 place-items-center rounded bg-[#E7ECE5]"><x-icon name="file" /></div>
                    @endif
                    <div>
                        <a
                            href="{{ route('admin.posts.edit', $post) }}">{{ $post->title }}</a><small>{{ ucwords(str_replace('_', ' ', $post->type)) }}</small>
                    </div>
                </div><span>{{ $post->category?->name ?? 'Uncategorized' }}</span><span><span
                        class="rounded-full px-2 py-1 text-[12px] font-semibold {{ match ($post->status) {'published' => 'bg-[#526A5A] text-white','scheduled' => 'bg-[#FFF0DC] text-[#8B5D21]','archived' => 'bg-[#EFEFEF] text-[#777]',default => 'bg-[#E7ECE5] text-[#3A5243]'} }}">{{ strtoupper($post->status) }}</span></span><span>{{ $post->updated_at->diffForHumans() }}</span>
                <div
                    class="flex items-center gap-2 md:justify-end [&_a]:text-[13px] [&_a]:font-medium [&_a]:text-[#526A5A] [&_a]:no-underline [&_button]:border-0 [&_button]:bg-transparent [&_button]:text-[13px] [&_button]:font-medium [&_button]:text-[#526A5A]">
                    <a href="{{ route('admin.posts.edit', $post) }}">Edit</a>
                    <form method="POST" action="{{ route('admin.posts.duplicate', $post) }}">
                        @csrf<button>Duplicate</button></form>
                    <form method="POST" action="{{ route('admin.posts.destroy', $post) }}"
                        onsubmit="return confirm('Move this content to trash?')">@csrf @method('DELETE')<button
                            class="text-[#B24E42]!">Delete</button></form>
                </div>
        </div>@empty<div class="p-10 text-center text-[#545F57]">
                <h3>Your journal is ready for its first story.</h3>
                <p>Start with a clinical case, educational article, quick note, or personal story.</p><a
                    class="inline-flex h-11 cursor-pointer items-center justify-center gap-2 rounded-md border border-transparent px-3.5 text-sm font-medium no-underline transition bg-[#526A5A] text-white hover:bg-[#293C32]"
                    href="{{ route('admin.posts.create') }}">Write Your First Post</a>
            </div>
        @endforelse
    </div>
    <div class="mt-[18px]">{{ $posts->links() }}</div>
@endsection
