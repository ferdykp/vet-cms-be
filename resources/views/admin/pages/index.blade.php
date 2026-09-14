@extends('admin.layouts.app')
@section('title', 'Pages · Content Studio')
@section('breadcrumb', 'Pages')
@section('content')
    <section class="flex flex-col items-start justify-between gap-6 mb-7 lg:flex-row">
        <div>
            <span class="text-[13px] font-semibold tracking-[0.09em] text-[#526A5A]">INFORMATIONAL PAGES</span>
            <h1>Pages</h1>
            <p>Manage About, Contact, and other evergreen content.</p>
        </div>
        <a class="inline-flex h-11 cursor-pointer items-center justify-center gap-2 rounded-md border border-transparent px-3.5 text-sm font-medium no-underline transition bg-[#526A5A] text-white hover:bg-[#293C32]"
            href="{{ route('admin.pages.create') }}"><x-icon name="plus" /> New Page</a>
    </section>
    <div class="overflow-hidden rounded-lg border border-[#EBEFEA] bg-white">
        @foreach ($pages as $page)
            <div
                class="grid grid-cols-1 items-center gap-2 border-t border-[#EBEFEA] px-4 py-3 text-sm md:grid-cols-[minmax(260px,1.6fr)_.8fr_.6fr_.7fr_1fr] md:gap-[15px] [&_small]:mt-1 [&_small]:block [&_small]:text-[#545F57] md:grid-cols-[2fr_.6fr_.6fr_.6fr]">
                <div>
                    <strong>{{ $page->title }}</strong>
                    <small>/{{ $page->slug }}</small>
                </div>
                <span
                    class="rounded-full px-2 py-1 text-[12px] font-semibold {{ $page->status === 'published' ? 'bg-[#526A5A] text-white' : 'bg-[#E7ECE5] text-[#3A5243]' }}">
                    {{ strtoupper($page->status) }}
                </span>
                <span>{{ $page->updated_at->diffForHumans() }}</span>
                <a href="{{ route('admin.pages.edit', $page) }}">Edit →</a>
            </div>
        @endforeach
    </div>
    <div class="mt-[18px]">{{ $pages->links() }}</div>
@endsection
