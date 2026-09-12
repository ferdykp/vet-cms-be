@extends('admin.layouts.app')
@section('title','Website Settings · Content Studio')
@section('breadcrumb','Website Settings')
@section('content')
<section class="mb-7"><span class="text-[10px] font-semibold tracking-[.1em] text-[#526A5A]">GLOBAL SITE CONFIGURATION</span><h1 class="mt-2 font-['Newsreader'] text-3xl font-medium text-[#293C32]">Website Settings</h1><p class="mt-2 max-w-2xl text-sm leading-6 text-[#70766F]">Global defaults used by the public frontend. Content itself is still managed from Journal, Profile, Resources, and Pages.</p></section>
<form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-5">@csrf @method('PUT') @php($i=0)
@forelse($settings as $group => $items)
<section class="rounded-2xl border border-[#E6EAE4] bg-white p-5 shadow-sm sm:p-6">
  <div class="mb-5 border-b border-[#EEF1ED] pb-3"><h2 class="text-sm font-semibold capitalize text-[#293C32]">{{ str_replace('_',' ',$group) }}</h2><p class="mt-1 text-xs text-[#8A908A]">{{ match($group) { 'general' => 'Basic site identity and contact details.', 'publishing' => 'Defaults for journal presentation.', 'seo' => 'Search engine defaults for the public site.', 'contact' => 'Public contact form behavior.', default => 'Configuration values for this section.' } }}</p></div>
  <div class="grid gap-5 md:grid-cols-2">
  @foreach($items as $setting)
    @php($pretty = str($setting->key)->afterLast('.')->replace('_',' ')->title())
    <div class="{{ $setting->type==='text' ? 'md:col-span-2' : '' }}">
      <input type="hidden" name="settings[{{ $i }}][group]" value="{{ $setting->group }}"><input type="hidden" name="settings[{{ $i }}][key]" value="{{ $setting->key }}"><input type="hidden" name="settings[{{ $i }}][type]" value="{{ $setting->type }}"><input type="hidden" name="settings[{{ $i }}][is_public]" value="{{ $setting->is_public ? 1 : 0 }}">
      @if($setting->type==='boolean')
        <label class="flex items-start justify-between gap-5 rounded-xl border border-[#EEF1ED] bg-[#FAFBF9] p-4"><span><strong class="block text-xs font-medium text-[#293C32]">{{ $pretty }}</strong><small class="mt-1 block text-[10px] leading-4 text-[#8A908A]">{{ $setting->key }}</small></span><span class="relative"><input type="hidden" name="settings[{{ $i }}][value]" value="0"><input type="checkbox" name="settings[{{ $i }}][value]" value="1" class="size-4 accent-[#526A5A]" @checked($setting->typed_value)></span></label>
      @elseif($setting->type==='text')
        <label class="block text-xs font-medium text-[#424843]">{{ $pretty }}<textarea name="settings[{{ $i }}][value]" class="mt-1 min-h-24 w-full rounded-lg border border-[#DDE2DF] bg-white px-3 py-2.5 text-sm outline-none focus:border-[#8FA58F]">{{ $setting->value }}</textarea><small class="mt-1 block text-[10px] text-[#8A908A]">{{ $setting->key }}</small></label>
      @else
        <label class="block text-xs font-medium text-[#424843]">{{ $pretty }}<input name="settings[{{ $i }}][value]" type="{{ in_array($setting->type,['integer','float']) ? 'number' : 'text' }}" value="{{ $setting->value }}" class="mt-1 w-full rounded-lg border border-[#DDE2DF] bg-white px-3 py-2.5 text-sm outline-none focus:border-[#8FA58F]"><small class="mt-1 block text-[10px] text-[#8A908A]">{{ $setting->key }}</small></label>
      @endif
    </div>
    @php($i++)
  @endforeach
  </div>
</section>
@empty
<div class="rounded-2xl border border-dashed border-[#C9D3C9] bg-[#F7FAF7] p-10 text-center"><h2 class="font-['Newsreader'] text-2xl text-[#293C32]">No website settings yet</h2><p class="mt-2 text-sm text-[#70766F]">Run <code class="rounded bg-white px-1.5 py-1">php artisan db:seed --class=WebsiteSettingSeeder</code> once.</p></div>
@endforelse
@if($i)<div class="sticky bottom-4 z-20 flex justify-end"><button class="rounded-xl bg-[#526A5A] px-5 py-3 text-sm font-medium text-white shadow-lg shadow-[#526A5A]/15 hover:bg-[#293C32]">Save Website Settings</button></div>@endif
</form>
@endsection
