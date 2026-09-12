@extends('admin.layouts.app')
@section('title','Tags · Content Studio')
@section('breadcrumb','Tags')
@section('content')
<section class="mb-7 flex flex-col items-start justify-between gap-5 lg:flex-row lg:items-end"><div><span class="text-[10px] font-semibold tracking-[.1em] text-[#526A5A]">DESCRIPTIVE TAXONOMY</span><h1 class="mt-2 font-['Newsreader'] text-3xl font-medium text-[#293C32]">Tags</h1><p class="mt-2 text-sm text-[#70766F]">Use tags for specific species, techniques, diseases, conferences, or recurring themes.</p></div>
<form class="flex h-10 items-center rounded-lg border border-[#DDE2DF] bg-white px-3" method="GET"><span class="text-[#9AA09A]">⌕</span><input class="w-48 border-0 bg-transparent px-2 text-xs outline-none" name="search" value="{{ request('search') }}" placeholder="Search tags"></form></section>
<div class="grid gap-5 xl:grid-cols-[minmax(0,1fr)_320px]">
<section class="overflow-hidden rounded-2xl border border-[#E6EAE4] bg-white shadow-sm">
@forelse($tags as $tag)
<div x-data="{editing:false}" class="border-b border-[#EEF1ED] last:border-b-0">
  <div class="flex flex-col gap-3 px-5 py-4 sm:flex-row sm:items-center sm:justify-between"><div><strong class="text-sm text-[#293C32]">#{{ $tag->name }}</strong><span class="ml-2 text-[11px] text-[#8A908A]">/{{ $tag->slug }}</span><p class="mt-1 text-[11px] text-[#70766F]">{{ $tag->posts_count }} {{ Str::plural('post',$tag->posts_count) }}</p></div><div class="flex gap-3"><button type="button" @click="editing=!editing" class="text-[11px] font-medium text-[#526A5A]">Edit</button><form method="POST" action="{{ route('admin.tags.destroy',$tag) }}" onsubmit="return confirm('Delete this tag?')">@csrf @method('DELETE')<button class="text-[11px] font-medium text-[#B24E42]">Delete</button></form></div></div>
  <form x-show="editing" x-transition x-cloak method="POST" action="{{ route('admin.tags.update',$tag) }}" class="grid gap-3 bg-[#FAFBF9] px-5 py-4 sm:grid-cols-[1fr_1fr_auto]">@csrf @method('PUT')<input class="rounded-lg border border-[#DDE2DF] bg-white px-3 py-2 text-xs" name="name" value="{{ $tag->name }}" required><input class="rounded-lg border border-[#DDE2DF] bg-white px-3 py-2 text-xs" name="slug" value="{{ $tag->slug }}"><button class="rounded-lg bg-[#526A5A] px-4 py-2 text-xs font-medium text-white">Save</button></form>
</div>
@empty<div class="p-10 text-center text-sm text-[#8A908A]">No tags found.</div>@endforelse
<div class="p-4">{{ $tags->links() }}</div>
</section>
<aside class="self-start rounded-2xl border border-[#E6EAE4] bg-white p-5 shadow-sm xl:sticky xl:top-24"><h2 class="text-sm font-semibold text-[#293C32]">Add Tag</h2><p class="mt-1 text-xs leading-5 text-[#70766F]">Prefer precise tags over broad duplicates of your categories.</p><form method="POST" action="{{ route('admin.tags.store') }}" class="mt-4 grid gap-3">@csrf<label class="text-[10px] font-medium uppercase text-[#70766F]">Name<input class="mt-1 w-full rounded-lg border border-[#DDE2DF] px-3 py-2.5 text-xs" name="name" required placeholder="e.g. feline"></label><button class="rounded-lg bg-[#526A5A] px-4 py-2.5 text-xs font-medium text-white">Add Tag</button></form></aside>
</div>
@endsection
