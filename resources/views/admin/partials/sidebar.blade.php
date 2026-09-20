<aside id="cms-navigation" aria-label="CMS navigation"
    class="fixed inset-y-0 left-0 z-50 flex w-60 max-w-[85vw] -translate-x-full flex-col border-r border-[#DDE2DF] bg-[#F0F5F0] transition-transform duration-200 lg:translate-x-0"
    :class="{ 'translate-x-0 shadow-2xl': mobileNav }">
    <div class="flex items-center gap-2.5 border-b border-[#E5E9E4] px-5 py-[22px]">
        <div class="grid size-8 place-items-center rounded-lg bg-[#526A5A] font-['Newsreader'] text-xl text-white">M
        </div>
        <div class="min-w-0">
            <strong class="block text-sm font-semibold text-[#293C32]">Content Studio</strong>
            <span class="block truncate text-[13px] text-[#545F57]">Veterinary Editorial</span>
        </div>
        <button type="button" @click="mobileNav=false"
            class="ml-auto grid size-8 place-items-center rounded-lg text-[#545F57] hover:bg-[#E7ECE5] hover:text-[#293C32] lg:hidden"
            aria-label="Close">
            <x-icon name="close" />
        </button>
    </div>

    <nav class="flex-1 px-3 py-4 overflow-y-auto">
        {{-- Helper style class untuk memperbersih Blade code --}}
        @php
            $baseClass =
                'my-0.5 flex items-center gap-2.5 rounded-md px-2.5 py-2.5 text-[15px] font-medium no-underline transition-all duration-150';
            $inactiveClass = 'text-[#252A27] hover:bg-[#E7ECE5] hover:text-[#14261D]';
            $activeClass = 'bg-[#526A5A] text-white hover:bg-[#293C32]';
        @endphp

        <div class="mb-[18px]">
            <span
                class="block px-2 pb-1.5 text-[13px] font-semibold uppercase tracking-[0.08em] text-[#545F57]">OVERVIEW</span>
            <a class="{{ $baseClass }} {{ request()->routeIs('admin.dashboard') ? $activeClass : $inactiveClass }}"
                href="{{ route('admin.dashboard') }}">
                <x-icon name="grid" /> <span>Dashboard</span>
            </a>
        </div>

        <div class="mb-[18px]">
            <span
                class="block px-2 pb-1.5 text-[13px] font-semibold uppercase tracking-[0.08em] text-[#545F57]">CONTENT</span>
            <a class="{{ $baseClass }} {{ request()->routeIs('admin.posts.*') ? $activeClass : $inactiveClass }}"
                href="{{ route('admin.posts.index') }}">
                <x-icon name="file" /> <span>Journal</span>
            </a>
            <a class="{{ $baseClass }} {{ request()->routeIs('admin.categories.*') ? $activeClass : $inactiveClass }}"
                href="{{ route('admin.categories.index') }}">
                <x-icon name="folder" /> <span>Categories</span>
            </a>
            <a class="{{ $baseClass }} {{ request()->routeIs('admin.tags.*') ? $activeClass : $inactiveClass }}"
                href="{{ route('admin.tags.index') }}">
                <x-icon name="tag" /> <span>Tags</span>
            </a>
        </div>

        <div class="mb-[18px]">
            <span
                class="block px-2 pb-1.5 text-[13px] font-semibold uppercase tracking-[0.08em] text-[#545F57]">MEDIA</span>
            <a class="{{ $baseClass }} {{ request()->routeIs('admin.media.*') ? $activeClass : $inactiveClass }}"
                href="{{ route('admin.media.index') }}">
                <x-icon name="image" /> <span>Media Library</span>
            </a>
        </div>

        <div class="mb-[18px]">
            <span
                class="block px-2 pb-1.5 text-[13px] font-semibold uppercase tracking-[0.08em] text-[#545F57]">WEBSITE</span>
            <a class="{{ $baseClass }} {{ request()->routeIs('admin.profile.*') ? $activeClass : $inactiveClass }}"
                href="{{ route('admin.profile.edit') }}">
                <x-icon name="user" /> <span>Profile</span>
            </a>
            <a class="{{ $baseClass }} {{ request()->routeIs('admin.resources.*') ? $activeClass : $inactiveClass }}"
                href="{{ route('admin.resources.index') }}">
                <x-icon name="book" /> <span>Resources</span>
            </a>
            <a class="{{ $baseClass }} {{ request()->routeIs('admin.pages.*') ? $activeClass : $inactiveClass }}"
                href="{{ route('admin.pages.index') }}">
                <x-icon name="file" /> <span>Pages</span>
            </a>
            <a class="{{ $baseClass }} {{ request()->routeIs('admin.navigation.*') ? $activeClass : $inactiveClass }}"
                href="{{ route('admin.navigation.index') }}">
                <x-icon name="nav" /> <span>Navigation</span>
            </a>
        </div>

        <div class="mb-[18px]">
            <span
                class="block px-2 pb-1.5 text-[13px] font-semibold uppercase tracking-[0.08em] text-[#545F57]">SETTINGS</span>
            <a class="{{ $baseClass }} {{ request()->routeIs('admin.settings.*') ? $activeClass : $inactiveClass }}"
                href="{{ route('admin.settings.index') }}">
                <x-icon name="settings" /> <span>Website Settings</span>
            </a>
            <a class="{{ $baseClass }} {{ request()->routeIs('admin.messages.*') ? $activeClass : $inactiveClass }}"
                href="{{ route('admin.messages.index') }}">
                <x-icon name="mail" /> <span>Inbox</span>
            </a>
        </div>
    </nav>

    <div class="border-t border-[#DDE2DF] p-3.5">
        <div class="flex items-center gap-2.5">
            <div class="grid size-7 place-items-center rounded-full bg-[#526A5A] text-[14px] font-semibold text-white">
                {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
            </div>
            <div class="min-w-0">
                <strong class="block truncate text-sm text-[#252A27]">{{ auth()->user()->name ?? 'Admin' }}</strong>
                <span class="block text-[13px] text-[#545F57]">Administrator</span>
            </div>
        </div>
        <div class="mt-3 flex gap-1.5">
            <a href="{{ config('app.frontend_url', env('FRONTEND_URL', '#')) }}" target="_blank"
                rel="noopener noreferrer"
                class="inline-flex h-11 flex-1 cursor-pointer items-center justify-center gap-2 rounded-md border border-[#DDE2DF] bg-white px-3.5 text-sm font-medium text-[#293C32] no-underline transition hover:bg-[#E7ECE5] hover:text-[#14261D]">
                ↗ View Site
            </a>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button
                    class="grid size-11 cursor-pointer place-items-center rounded-md border border-[#DDE2DF] bg-white text-[#252A27] transition hover:bg-[#E7ECE5] hover:text-[#991B1B]"
                    title="Logout">
                    <x-icon name="logout" />
                </button>
            </form>
        </div>
    </div>
</aside>
