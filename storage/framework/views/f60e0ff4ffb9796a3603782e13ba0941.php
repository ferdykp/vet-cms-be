<?php $__env->startSection('title', 'Pages · Content Studio'); ?>
<?php $__env->startSection('breadcrumb', 'Pages'); ?>
<?php $__env->startSection('content'); ?>
    <section class="flex flex-col items-start justify-between gap-6 mb-7 lg:flex-row">
        <div>
            <span class="text-[10px] font-semibold tracking-[0.09em] text-[#526A5A]">INFORMATIONAL PAGES</span>
            <h1>Pages</h1>
            <p>Manage About, Contact, and other evergreen content.</p>
        </div>
        <a class="inline-flex h-[38px] cursor-pointer items-center justify-center rounded-md border border-transparent px-3.5 text-xs font-medium no-underline transition bg-[#526A5A] text-white hover:bg-[#293C32]"
            href="<?php echo e(route('admin.pages.create')); ?>">＋ New Page</a>
    </section>
    <div class="overflow-hidden rounded-lg border border-[#EBEFEA] bg-white">
        <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div
                class="grid grid-cols-1 items-center gap-2 border-t border-[#EBEFEA] px-4 py-3 text-xs md:grid-cols-[minmax(260px,1.6fr)_.8fr_.6fr_.7fr_1fr] md:gap-[15px] [&_small]:mt-1 [&_small]:block [&_small]:text-[#70766F] md:grid-cols-[2fr_.6fr_.6fr_.6fr]">
                <div>
                    <strong><?php echo e($page->title); ?></strong>
                    <small>/<?php echo e($page->slug); ?></small>
                </div>
                <span
                    class="rounded-full px-2 py-1 text-[9px] font-semibold <?php echo e($page->status === 'published' ? 'bg-[#526A5A] text-white' : 'bg-[#E7ECE5] text-[#3A5243]'); ?>">
                    <?php echo e(strtoupper($page->status)); ?>

                </span>
                <span><?php echo e($page->updated_at->diffForHumans()); ?></span>
                <a href="<?php echo e(route('admin.pages.edit', $page)); ?>">Edit →</a>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="mt-[18px]"><?php echo e($pages->links()); ?></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/ferdy/project-fl/vet-cms/backend/resources/views/admin/pages/index.blade.php ENDPATH**/ ?>