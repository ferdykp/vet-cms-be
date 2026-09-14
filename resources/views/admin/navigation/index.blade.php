@extends('admin.layouts.app')
@section('title','Navigation · Content Studio')
@section('breadcrumb','Navigation')
@section('content')
<section class="mb-7"><span class="text-[13px] font-semibold tracking-[.1em] text-[#526A5A]">PUBLIC MENU STRUCTURE</span><h1 class="mt-2 font-['Newsreader'] text-3xl font-medium text-[#293C32]">Navigation</h1><p class="mt-2 max-w-2xl text-sm leading-6 text-[#545F57]">Keep the public navigation short and predictable. Home, Journal, About, Resources, and Contact are usually enough.</p></section>
<div class="grid gap-5 xl:grid-cols-[minmax(0,1fr)_340px]">
<section class="rounded-2xl border border-[#E6EAE4] bg-white p-5 shadow-sm">
  <div class="mb-4 flex items-center justify-between"><h2 class="text-sm font-semibold text-[#293C32]">Menu items</h2><span class="text-[13px] text-[#5B675E]">Edit visibility, URL, and order</span></div>
  <div class="space-y-2">
  @forelse($items as $item)
    <div x-data="{editing:false}" class="rounded-xl border border-[#EEF1ED] bg-[#FCFDFC]">
      <div class="flex items-center justify-between gap-4 px-4 py-3"><div class="min-w-0"><div class="flex items-center gap-2"><span class="text-[#5B675E]"><x-icon name="settings" /></span><strong class="truncate text-sm text-[#293C32]">{{ $item->label }}</strong>@if(!$item->is_active)<span class="rounded-full bg-[#F0F1EF] px-2 py-0.5 text-[12px] text-[#777]">Hidden</span>@endif</div><p class="mt-1 text-[13px] text-[#5B675E]">{{ $item->type }} · {{ $item->url ?: 'resolved automatically' }} · order {{ $item->sort_order }}</p></div><div class="flex gap-3"><button @click="editing=!editing" type="button" class="text-[14px] font-medium text-[#526A5A]">Edit</button><form method="POST" action="{{ route('admin.navigation.destroy',$item) }}" onsubmit="return confirm('Delete this menu item and its children?')">@csrf @method('DELETE')<button class="text-[14px] text-[#B24E42]">Delete</button></form></div></div>
      <form x-show="editing" x-transition x-cloak method="POST" action="{{ route('admin.navigation.update',$item) }}" class="grid gap-3 border-t border-[#EEF1ED] bg-white px-4 py-4 md:grid-cols-2">@csrf @method('PUT')
        <label class="text-[13px] font-medium uppercase text-[#545F57]">Label<input class="mt-1 w-full rounded-lg border border-[#DDE2DF] px-3 py-2 text-sm" name="label" value="{{ $item->label }}" required></label>
        <label class="text-[13px] font-medium uppercase text-[#545F57]">Type<select class="mt-1 w-full rounded-lg border border-[#DDE2DF] px-3 py-2 text-sm" name="type">@foreach(['home','journal','page','category','external'] as $v)<option value="{{ $v }}" @selected($item->type===$v)>{{ ucfirst($v) }}</option>@endforeach</select></label>
        <label class="text-[13px] font-medium uppercase text-[#545F57]">URL<input class="mt-1 w-full rounded-lg border border-[#DDE2DF] px-3 py-2 text-sm" name="url" value="{{ $item->url }}" placeholder="/about or https://..."></label>
        <label class="text-[13px] font-medium uppercase text-[#545F57]">Order<input class="mt-1 w-full rounded-lg border border-[#DDE2DF] px-3 py-2 text-sm" type="number" min="0" name="sort_order" value="{{ $item->sort_order }}"></label>
        <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="is_active" value="1" @checked($item->is_active)> Visible</label>
        <div class="flex justify-end"><button class="rounded-lg bg-[#526A5A] px-4 py-2 text-sm font-medium text-white">Save</button></div>
      </form>
      @if($item->children->isNotEmpty())<div class="border-t border-[#EEF1ED] px-4 pb-3 pt-2">@foreach($item->children as $child)<div class="flex justify-between py-2 pl-5 text-[14px]"><span class="text-[#424843]">↳ {{ $child->label }}</span><span class="text-[#5B675E]">{{ $child->type }}</span></div>@endforeach</div>@endif
    </div>
  @empty<div class="py-10 text-center text-sm text-[#5B675E]">No navigation items yet.</div>@endforelse
  </div>
</section>
<aside class="self-start rounded-2xl border border-[#E6EAE4] bg-white p-5 shadow-sm xl:sticky xl:top-24"><h2 class="text-sm font-semibold text-[#293C32]">Add menu item</h2><p class="mt-1 text-sm leading-5 text-[#545F57]">For standard pages, use a relative URL such as <code>/about</code>.</p><form method="POST" action="{{ route('admin.navigation.store') }}" class="mt-4 grid gap-3">@csrf
<label class="text-[13px] font-medium uppercase text-[#545F57]">Label<input class="mt-1 w-full rounded-lg border border-[#DDE2DF] px-3 py-2.5 text-sm" name="label" required></label>
<label class="text-[13px] font-medium uppercase text-[#545F57]">Type<select class="mt-1 w-full rounded-lg border border-[#DDE2DF] px-3 py-2.5 text-sm" name="type">@foreach(['home','journal','page','category','external'] as $v)<option value="{{ $v }}">{{ ucfirst($v) }}</option>@endforeach</select></label>
<label class="text-[13px] font-medium uppercase text-[#545F57]">URL<input class="mt-1 w-full rounded-lg border border-[#DDE2DF] px-3 py-2.5 text-sm" name="url" placeholder="/about"></label>
<label class="text-[13px] font-medium uppercase text-[#545F57]">Order<input class="mt-1 w-full rounded-lg border border-[#DDE2DF] px-3 py-2.5 text-sm" type="number" min="0" name="sort_order" value="0"></label>
<label class="flex items-center gap-2 text-sm"><input type="checkbox" name="is_active" value="1" checked> Visible</label><button class="rounded-lg bg-[#526A5A] px-4 py-2.5 text-sm font-medium text-white">Add Menu Item</button></form></aside>
</div>
@endsection
