<?php $__env->startSection('title', 'Pages · Content Studio'); ?>
<?php $__env->startSection('breadcrumb', 'Pages'); ?>
<?php $__env->startSection('content'); ?>
    <section class="flex flex-col items-start justify-between gap-6 mb-7 lg:flex-row">
        <div>
            <span class="text-[13px] font-semibold tracking-[0.09em] text-[#526A5A]">INFORMATIONAL PAGES</span>
            <h1>Pages</h1>
            <p>Manage About, Contact, and other evergreen content.</p>
        </div>
        <a class="inline-flex h-11 cursor-pointer items-center justify-center gap-2 rounded-md border border-transparent px-3.5 text-sm font-medium no-underline transition bg-[#526A5A] text-white hover:bg-[#293C32]"
            href="<?php echo e(route('admin.pages.create')); ?>"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'plus']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'plus']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?> New Page</a>
    </section>
    <div class="overflow-hidden rounded-lg border border-[#EBEFEA] bg-white">
        <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div
                class="grid grid-cols-1 items-center gap-2 border-t border-[#EBEFEA] px-4 py-3 text-sm md:grid-cols-[minmax(260px,1.6fr)_.8fr_.6fr_.7fr_1fr] md:gap-[15px] [&_small]:mt-1 [&_small]:block [&_small]:text-[#545F57] md:grid-cols-[2fr_.6fr_.6fr_.6fr]">
                <div>
                    <strong><?php echo e($page->title); ?></strong>
                    <small>/<?php echo e($page->slug); ?></small>
                </div>
                <span
                    class="rounded-full px-2 py-1 text-[12px] font-semibold <?php echo e($page->status === 'published' ? 'bg-[#526A5A] text-white' : 'bg-[#E7ECE5] text-[#3A5243]'); ?>">
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