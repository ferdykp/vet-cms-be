@extends('admin.layouts.app')
@section('title', 'Media Library · Content Studio')
@section('breadcrumb', 'Media Library')
@section('content')
    <section class="mb-7 flex flex-col items-start justify-between gap-5 lg:flex-row lg:items-end">
        <div class="max-w-2xl">
            <span class="text-[13px] font-semibold tracking-[.1em] text-[#526A5A]">CLINICAL ARCHIVE & PRESS</span>
            <h1 class="mt-2 font-['Newsreader'] text-3xl font-medium text-[#293C32]">Media Library</h1>
            <p class="mt-2 text-sm leading-6 text-[#545F57]">Manage clinical photography, cytology slides, diagrams,
                documents, and editorial images in one place.</p>
        </div>
        <form method="POST" action="{{ route('admin.media.store') }}" enctype="multipart/form-data">
            @csrf
            <label
                class="inline-flex h-10 cursor-pointer items-center rounded-lg bg-[#526A5A] px-4 text-sm font-medium text-white shadow-sm hover:bg-[#293C32]">
                <x-icon name="plus" /> Upload Media
                <input type="file" name="files[]" multiple
                    accept="image/jpeg,image/png,image/webp,image/gif,.pdf,.doc,.docx" class="sr-only"
                    onchange="if(this.files.length) this.form.requestSubmit()">
            </label>
        </form>
    </section>

    {{-- Filter & Search Bar --}}
    <div
        class="mb-5 flex flex-col gap-3 rounded-2xl border border-[#E6EAE4] bg-white p-3 shadow-sm sm:flex-row sm:items-center sm:justify-between">
        <form class="flex flex-1 flex-wrap gap-2">
            <div class="flex min-w-0 flex-1 items-center rounded-lg border border-[#DDE2DF] bg-white px-3">
                <span class="text-[#5B675E]"><x-icon name="search" /></span>
                <input class="w-full border-0 bg-transparent px-2 py-2.5 text-sm outline-none" name="search"
                    value="{{ request('search') }}" placeholder="Search filename or alt text">
            </div>
            <select class="rounded-lg border border-[#DDE2DF] bg-white px-3 py-2 text-sm" name="filter">
                <option value="">All media</option>
                <option value="images" @selected(request('filter') === 'images')>Images</option>
                <option value="documents" @selected(request('filter') === 'documents')>Documents</option>
            </select>
            <button
                class="rounded-lg border border-[#DDE2DF] bg-[#F7F9F6] px-4 py-2 text-sm font-medium text-[#293C32]">Apply</button>
        </form>
        <span class="text-[13px] text-[#5B675E]">{{ $media->total() }} assets</span>
    </div>

    {{-- Main Container --}}
    <div class="grid gap-5 xl:grid-cols-[minmax(0,1fr)_340px]">
        <div>
            <div class="grid grid-cols-1 min-[360px]:grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5">
                @forelse($media as $asset)
                    <div
                        class="group relative overflow-hidden rounded-xl border border-[#E6EAE4] bg-white text-left shadow-sm transition hover:border-[#8FA58F] hover:shadow-md">

                        {{-- Tombol Klik Preview --}}
                        <button type="button"
                            onclick="showInspector('{{ $asset->id }}', '{{ addslashes($asset->original_name) }}', '{{ $asset->url }}', '{{ $asset->size }}', '{{ $asset->width }}', '{{ $asset->height }}', '{{ addslashes($asset->alt_text ?? '') }}', '{{ addslashes($asset->caption ?? '') }}')"
                            class="w-full text-left">
                            <div class="aspect-square overflow-hidden bg-[#EEF3ED]">
                                @if (str_starts_with($asset->mime_type ?? '', 'image/'))
                                    <img src="{{ $asset->url }}" alt="{{ $asset->alt_text ?: $asset->original_name }}"
                                        class="h-full w-full object-cover transition duration-300 group-hover:scale-[1.02]">
                                @else
                                    <div class="grid h-full place-items-center">
                                        <span class="rounded-lg bg-white px-3 py-2 text-sm font-semibold text-[#526A5A]">
                                            {{ strtoupper($asset->extension ?? 'FILE') }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                            <div class="p-3">
                                <strong
                                    class="block truncate text-[14px] text-[#293C32]">{{ $asset->original_name }}</strong>
                                <span
                                    class="mt-1 block truncate text-[12px] text-[#5B675E]">{{ $asset->alt_text ?: $asset->mime_type ?? 'asset' }}</span>
                            </div>
                        </button>

                        {{-- TOMBOL HAPUS CEPAT (HOVER DI KARTU FOTO) --}}
                        <form method="POST" action="{{ route('admin.media.destroy', $asset->id) }}"
                            onsubmit="return confirm('Hapus media {{ addslashes($asset->original_name) }} ini?')"
                            class="absolute top-2 right-2 opacity-0 transition-opacity group-hover:opacity-100 z-10">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="flex size-8 items-center justify-center rounded-lg bg-red-600 text-white shadow-md hover:bg-red-700"
                                title="Delete Media">
                                ✕
                            </button>
                        </form>

                    </div>
                @empty
                    <div
                        class="col-span-full rounded-2xl border border-dashed border-[#C9D3C9] bg-[#F7FAF7] p-12 text-center">
                        <p class="text-sm font-medium text-[#526A5A]">No media yet</p>
                        <p class="mt-1 text-sm text-[#5B675E]">Upload your first image or document using the button above.
                        </p>
                    </div>
                @endforelse
            </div>
            <div class="mt-5">{{ $media->links() }}</div>
        </div>

        {{-- Panel Side Inspector (Vanila JS) --}}
        <div>
            <!-- Box Saat Ada Foto Diklik -->
            <aside id="inspector-panel"
                class="hidden rounded-2xl border border-[#E6EAE4] bg-white p-5 shadow-sm xl:sticky xl:top-24">
                <div class="mb-4 flex items-start justify-between gap-3">
                    <div class="min-w-0">
                        <p class="text-[13px] font-semibold uppercase tracking-[.08em] text-[#8FA58F]">Asset Inspector</p>
                        <h2 id="ins-name" class="mt-1 truncate text-sm font-semibold text-[#293C32]"></h2>
                    </div>
                    <button type="button" onclick="hideInspector()"
                        class="grid size-8 shrink-0 place-items-center rounded-lg text-[#545F57] hover:bg-[#F0F5F0]">✕</button>
                </div>

                <div class="overflow-hidden rounded-xl bg-[#EEF3ED]">
                    <img id="ins-img" src="" class="aspect-video w-full object-cover">
                </div>

                <div class="mt-4 grid grid-cols-2 gap-2 rounded-xl bg-[#F7F9F6] p-3">
                    <div>
                        <small class="text-[12px] uppercase text-[#5B675E]">Size</small>
                        <strong id="ins-size" class="mt-1 block text-sm text-[#293C32]"></strong>
                    </div>
                    <div>
                        <small class="text-[12px] uppercase text-[#5B675E]">Dimensions</small>
                        <strong id="ins-dim" class="mt-1 block text-sm text-[#293C32]"></strong>
                    </div>
                </div>

                <form id="ins-form-update" method="POST" action="" class="mt-4 grid gap-3">
                    @csrf
                    @method('PUT')
                    <label class="text-[13px] font-medium uppercase tracking-wide text-[#545F57]">
                        Alt text
                        <textarea id="ins-alt" name="alt_text"
                            class="mt-1 min-h-20 w-full rounded-lg border border-[#DDE2DF] px-3 py-2 text-sm outline-none focus:border-[#8FA58F]"></textarea>
                    </label>
                    <label class="text-[13px] font-medium uppercase tracking-wide text-[#545F57]">
                        Caption
                        <textarea id="ins-caption" name="caption"
                            class="mt-1 min-h-20 w-full rounded-lg border border-[#DDE2DF] px-3 py-2 text-sm outline-none focus:border-[#8FA58F]"></textarea>
                    </label>
                    <button
                        class="rounded-lg bg-[#526A5A] px-4 py-2.5 text-sm font-medium text-white hover:bg-[#293C32]">Save
                        Metadata</button>
                </form>

                <div class="mt-4 flex items-center justify-between border-t border-[#EEF1ED] pt-4">
                    <a id="ins-url" href="#" target="_blank" rel="noopener noreferrer"
                        class="text-[14px] font-medium text-[#526A5A] hover:underline">Open original ↗</a>

                    <form id="ins-form-delete" method="POST" action=""
                        onsubmit="return confirm('Delete this media asset?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-[14px] font-medium text-[#B24E42] hover:underline">Delete
                            Asset</button>
                    </form>
                </div>
            </aside>

            <!-- Box Saat Belum Ada Foto Diklik -->
            <aside id="inspector-placeholder"
                class="rounded-2xl border border-dashed border-[#C9D3C9] bg-[#F7FAF7] p-7 text-center xl:sticky xl:top-24">
                <div class="mx-auto grid size-11 place-items-center rounded-xl bg-white text-xl text-[#526A5A]">
                    <x-icon name="image" />
                </div>
                <h2 class="mt-3 text-sm font-semibold text-[#293C32]">Select an asset</h2>
                <p class="mt-1 text-sm leading-5 text-[#5B675E]">Click any media card to inspect dimensions or delete
                    unused files.</p>
            </aside>
        </div>
    </div>

    {{-- Script Murni Sederhana --}}
    <script>
        function showInspector(id, name, url, size, width, height, alt, caption) {
            document.getElementById('inspector-placeholder').classList.add('hidden');
            document.getElementById('inspector-panel').classList.remove('hidden');

            document.getElementById('ins-name').innerText = name;
            document.getElementById('ins-img').src = url;
            document.getElementById('ins-size').innerText = size ? (size / 1024).toFixed(1) + ' KB' : '—';
            document.getElementById('ins-dim').innerText = (width && width > 0) ? width + ' × ' + height : '—';
            document.getElementById('ins-alt').value = alt;
            document.getElementById('ins-caption').value = caption;
            document.getElementById('ins-url').href = url;

            document.getElementById('ins-form-update').action = '/admin/media/' + id;
            document.getElementById('ins-form-delete').action = '/admin/media/' + id;
        }

        function hideInspector() {
            document.getElementById('inspector-panel').classList.add('hidden');
            document.getElementById('inspector-placeholder').classList.remove('hidden');
        }
    </script>
@endsection
