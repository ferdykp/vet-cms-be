@props(['name' => 'file'])
@php
$paths = [
    'grid' => 'M3 3h7v7H3zM14 3h7v7h-7zM3 14h7v7H3zM14 14h7v7h-7z',
    'book' => 'M12 6v15M3 3h5a4 4 0 0 1 4 3 4 4 0 0 1 4-3h5v16h-5a4 4 0 0 0-4 2 4 4 0 0 0-4-2H3z',
    'folder' => 'M3 7V4h6l2 3h10v13H3z',
    'tag' => 'M3 3h8l10 10-8 8L3 11zM7 7h.01',
    'image' => 'M3 3h18v18H3zM3 16l5-5 4 4 3-3 6 6M16 7h.01',
    'user' => 'M20 21v-2a6 6 0 0 0-6-6h-4a6 6 0 0 0-6 6v2M16 7a4 4 0 1 1-8 0 4 4 0 0 1 8 0',
    'file' => 'M14 2H4v20h16V8zM14 2v6h6M8 13h8M8 17h6',
    'nav' => 'm12 3 9 18-9-5-9 5z',
    'settings' => 'M4 6h16M4 12h16M4 18h16M8 3v6M16 9v6M10 15v6',
    'mail' => 'M3 5h18v14H3zM3 5l9 7 9-7',
    'search' => 'M21 21l-4.5-4.5M19 10.5a8.5 8.5 0 1 1-17 0 8.5 8.5 0 0 1 17 0',
    'menu' => 'M4 6h16M4 12h16M4 18h16',
    'close' => 'M6 6l12 12M6 18 18 6',
    'arrow' => 'M4 12h16m-6-6 6 6-6 6',
    'external' => 'M7 17 17 7M7 7h10v10',
    'plus' => 'M12 5v14M5 12h14',
    'edit' => 'm16 3 5 5-12 12-6 1 1-6zM14 5l5 5',
    'logout' => 'M9 3H3v18h6M9 12h12m-4-4 4 4-4 4',
    'check' => 'm5 12 4 4L19 6',
    'up' => 'm6 14 6-6 6 6',
    'down' => 'm6 10 6 6 6-6',
    'eye' => 'M2 12s4-7 10-7 10 7 10 7-4 7-10 7S2 12 2 12M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0',
    'quote' => 'M3 5h7v8H6v6H3zM14 5h7v8h-4v6h-3z',
    'award' => 'M12 15a6 6 0 1 0 0-12 6 6 0 0 0 0 12M8 14l-2 7 6-3 6 3-2-7',
];
@endphp
<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false" {{ $attributes->class(['inline-block size-5 shrink-0 align-middle']) }}><path d="{{ $paths[$name] ?? $paths['file'] }}" /></svg>
