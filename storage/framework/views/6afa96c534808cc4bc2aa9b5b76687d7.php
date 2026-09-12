<header class="sticky top-0 z-40 flex h-16 items-center justify-between border-b border-[#E5E9E4] bg-[#F7F5EF]/90 px-3.5 backdrop-blur-xl sm:px-7">
    <button type="button" aria-label="Open navigation" class="grid size-9 place-items-center rounded-lg border border-[#DDE2DF] bg-white text-lg lg:hidden" @click="mobileNav=true">☰</button>
    <div class="flex items-center gap-3 text-xs [&_span]:text-[#70766F] [&_i]:text-[#C2C8C1]"><span>Studio</span><i>›</i><strong><?php echo $__env->yieldContent('breadcrumb','Workspace'); ?></strong></div>
    <div class="flex items-center gap-3.5">
        <form class="hidden h-9 min-w-[200px] items-center rounded-md border border-[#DDE2DF] bg-white px-2.5 lg:flex lg:min-w-[260px] [&_input]:w-full [&_input]:border-0 [&_input]:bg-transparent [&_input]:text-xs [&_input]:outline-none" action="<?php echo e(route('admin.posts.index')); ?>"><span>⌕</span><input name="search" placeholder="Search journal..."></form>
        <a class="hidden text-xs text-[#293C32] no-underline xl:inline" href="<?php echo e(config('app.frontend_url', env('FRONTEND_URL','#'))); ?>" target="_blank">◉ View Live Website</a>
        <a class="inline-flex h-[38px] cursor-pointer items-center justify-center rounded-md border border-transparent px-3.5 text-xs font-medium no-underline transition bg-[#526A5A] text-white hover:bg-[#293C32]" href="<?php echo e(route('admin.posts.create')); ?>">＋ New Content</a>
    </div>
</header><?php /**PATH /Users/ferdy/project-fl/vet-cms/backend/resources/views/admin/partials/topbar.blade.php ENDPATH**/ ?>