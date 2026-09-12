<aside
    class="fixed inset-y-0 left-0 z-50 flex w-60 -translate-x-full flex-col border-r border-[#DDE2DF] bg-[#F0F5F0] transition-transform duration-200 lg:translate-x-0"
    :class="{ 'translate-x-0 shadow-2xl': mobileNav }">
    <div class="flex items-center gap-2.5 border-b border-[#E5E9E4] px-5 py-[22px]">
        <div class="grid size-8 place-items-center rounded-lg bg-[#526A5A] font-['Newsreader'] text-xl text-white">M
        </div>
        <div class="min-w-0"><strong class="block text-sm font-semibold text-[#293C32]">Content Studio</strong><span class="block truncate text-[10px] text-[#70766F]">Veterinary Editorial</span></div><button type="button" @click="mobileNav=false" class="ml-auto grid size-8 place-items-center rounded-lg text-[#70766F] hover:bg-[#E7ECE5] lg:hidden">×</button>
    </div>
    <nav class="flex-1 px-3 py-4 overflow-y-auto">
        <div
            class="mb-[18px] [&>span]:block [&>span]:px-2 [&>span]:pb-1.5 [&>span]:text-[10px] [&>span]:uppercase [&>span]:tracking-[0.08em] [&>span]:text-[#70766F]">
            <span>OVERVIEW</span>
            <a class="my-0.5 flex items-center gap-2.5 rounded-md px-2.5 py-2.5 text-[13px] text-[#252A27] no-underline transition hover:bg-[#E7ECE5] <?php echo e(request()->routeIs('admin.dashboard') ? 'bg-[#526A5A] text-white' : ''); ?>"
                href="<?php echo e(route('admin.dashboard')); ?>">▦ <span>Dashboard</span></a>
        </div>
        <div
            class="mb-[18px] [&>span]:block [&>span]:px-2 [&>span]:pb-1.5 [&>span]:text-[10px] [&>span]:uppercase [&>span]:tracking-[0.08em] [&>span]:text-[#70766F]">
            <span>CONTENT</span>
            <a class="my-0.5 flex items-center gap-2.5 rounded-md px-2.5 py-2.5 text-[13px] text-[#252A27] no-underline transition hover:bg-[#E7ECE5] <?php echo e(request()->routeIs('admin.posts.*') ? 'bg-[#526A5A] text-white' : ''); ?>"
                href="<?php echo e(route('admin.posts.index')); ?>">▤ <span>Journal</span></a>
            
            <a class="my-0.5 flex items-center gap-2.5 rounded-md px-2.5 py-2.5 text-[13px] text-[#252A27] no-underline transition hover:bg-[#E7ECE5] <?php echo e(request()->routeIs('admin.categories.*') ? 'bg-[#526A5A] text-white' : ''); ?>"
                href="<?php echo e(route('admin.categories.index')); ?>">▱ <span>Categories</span></a>
            <a class="my-0.5 flex items-center gap-2.5 rounded-md px-2.5 py-2.5 text-[13px] text-[#252A27] no-underline transition hover:bg-[#E7ECE5] <?php echo e(request()->routeIs('admin.tags.*') ? 'bg-[#526A5A] text-white' : ''); ?>"
                href="<?php echo e(route('admin.tags.index')); ?>">◇ <span>Tags</span></a>
        </div>
        <div
            class="mb-[18px] [&>span]:block [&>span]:px-2 [&>span]:pb-1.5 [&>span]:text-[10px] [&>span]:uppercase [&>span]:tracking-[0.08em] [&>span]:text-[#70766F]">
            <span>MEDIA</span>
            <a class="my-0.5 flex items-center gap-2.5 rounded-md px-2.5 py-2.5 text-[13px] text-[#252A27] no-underline transition hover:bg-[#E7ECE5] <?php echo e(request()->routeIs('admin.media.*') ? 'bg-[#526A5A] text-white' : ''); ?>"
                href="<?php echo e(route('admin.media.index')); ?>">▧ <span>Media Library</span></a>
        </div>
        <div
            class="mb-[18px] [&>span]:block [&>span]:px-2 [&>span]:pb-1.5 [&>span]:text-[10px] [&>span]:uppercase [&>span]:tracking-[0.08em] [&>span]:text-[#70766F]">
            <span>WEBSITE</span>
            <a class="my-0.5 flex items-center gap-2.5 rounded-md px-2.5 py-2.5 text-[13px] text-[#252A27] no-underline transition hover:bg-[#E7ECE5] <?php echo e(request()->routeIs('admin.profile.*') ? 'bg-[#526A5A] text-white' : ''); ?>"
                href="<?php echo e(route('admin.profile.edit')); ?>">♙ <span>Profile</span></a>
            <a class="my-0.5 flex items-center gap-2.5 rounded-md px-2.5 py-2.5 text-[13px] text-[#252A27] no-underline transition hover:bg-[#E7ECE5] <?php echo e(request()->routeIs('admin.resources.*') ? 'bg-[#526A5A] text-white' : ''); ?>"
                href="<?php echo e(route('admin.resources.index')); ?>">▥ <span>Resources</span></a>
            <a class="my-0.5 flex items-center gap-2.5 rounded-md px-2.5 py-2.5 text-[13px] text-[#252A27] no-underline transition hover:bg-[#E7ECE5] <?php echo e(request()->routeIs('admin.pages.*') ? 'bg-[#526A5A] text-white' : ''); ?>"
                href="<?php echo e(route('admin.pages.index')); ?>">▤ <span>Pages</span></a>
            <a class="my-0.5 flex items-center gap-2.5 rounded-md px-2.5 py-2.5 text-[13px] text-[#252A27] no-underline transition hover:bg-[#E7ECE5] <?php echo e(request()->routeIs('admin.navigation.*') ? 'bg-[#526A5A] text-white' : ''); ?>"
                href="<?php echo e(route('admin.navigation.index')); ?>">△ <span>Navigation</span></a>
        </div>
        <div
            class="mb-[18px] [&>span]:block [&>span]:px-2 [&>span]:pb-1.5 [&>span]:text-[10px] [&>span]:uppercase [&>span]:tracking-[0.08em] [&>span]:text-[#70766F]">
            <span>SETTINGS</span>
            <a class="my-0.5 flex items-center gap-2.5 rounded-md px-2.5 py-2.5 text-[13px] text-[#252A27] no-underline transition hover:bg-[#E7ECE5] <?php echo e(request()->routeIs('admin.settings.*') ? 'bg-[#526A5A] text-white' : ''); ?>"
                href="<?php echo e(route('admin.settings.index')); ?>">☷ <span>Website Settings</span></a>
            <a class="my-0.5 flex items-center gap-2.5 rounded-md px-2.5 py-2.5 text-[13px] text-[#252A27] no-underline transition hover:bg-[#E7ECE5] <?php echo e(request()->routeIs('admin.messages.*') ? 'bg-[#526A5A] text-white' : ''); ?>"
                href="<?php echo e(route('admin.messages.index')); ?>">✉ <span>Inbox</span></a>
        </div>
    </nav>
    <div class="border-t border-[#DDE2DF] p-3.5">
        <div class="flex items-center gap-2.5 [&_strong]:text-xs">
            <div class="grid size-7 place-items-center rounded-full bg-[#526A5A] text-[11px] text-white">
                <?php echo e(strtoupper(substr(auth()->user()->name ?? 'A', 0, 1))); ?></div>
            <div class="min-w-0"><strong class="block truncate"><?php echo e(auth()->user()->name ?? 'Admin'); ?></strong><span class="block text-[10px] text-[#70766F]">Administrator</span></div>
        </div>
        <div class="mt-3 flex gap-1.5">
            <a href="<?php echo e(config('app.frontend_url', env('FRONTEND_URL', '#'))); ?>" target="_blank"
                class="inline-flex h-[38px] cursor-pointer items-center justify-center rounded-md border border-transparent px-3.5 text-xs font-medium no-underline transition border-[#DDE2DF] bg-white text-[#293C32] hover:bg-[#F7F5EF] h-[34px]">↗
                View Site</a>
            <form method="POST" action="<?php echo e(route('admin.logout')); ?>"><?php echo csrf_field(); ?><button
                    class="grid size-[34px] cursor-pointer place-items-center rounded-md border border-[#DDE2DF] bg-white"
                    title="Logout">⇥</button></form>
        </div>
    </div>
</aside>
<?php /**PATH /Users/ferdy/project-fl/vet-cms/backend/resources/views/admin/partials/sidebar.blade.php ENDPATH**/ ?>