<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Content Studio')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Newsreader:opsz,wght@6..72,400;6..72,500;6..72,600&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    @stack('head')
</head>

<body class="m-0 min-h-screen bg-[#F7F5EF] font-sans text-[#252A27] antialiased">
    <div class="flex min-h-screen" x-data="cmsShell()">
        <div x-show="mobileNav" x-transition.opacity x-cloak @click="mobileNav=false" class="fixed inset-0 z-40 bg-[#1C2821]/35 backdrop-blur-[1px] lg:hidden"></div>
        @include('admin.partials.sidebar')
        <div class="flex-1 min-w-0 lg:ml-60">
            @include('admin.partials.topbar')
            <main class="px-4 pb-16 pt-6 sm:px-7 lg:px-8 @yield('content-class')">
                @if (session('success'))
                    <div class="mb-[18px] rounded-md px-3.5 py-3 text-[13px] bg-[#E7F1E8] text-[#2E5A3B]">
                        {{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="mb-[18px] rounded-md px-3.5 py-3 text-[13px] bg-[#FFF0EE] text-[#8A2F27]">
                        {{ session('error') }}</div>
                @endif
                @if ($errors->any())
                    <div class="mb-[18px] rounded-md px-3.5 py-3 text-[13px] bg-[#FFF0EE] text-[#8A2F27]"><strong>Please
                            review the form.</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>
    @stack('scripts')
</body>

</html>
