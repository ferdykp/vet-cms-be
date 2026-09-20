 <?php $__env->startSection('title','Resources · Content Studio'); ?> <?php $__env->startSection('breadcrumb','Resources'); ?> <?php $__env->startSection('content'); ?><section class="mb-7 flex flex-col items-start justify-between gap-6 lg:flex-row"><div><span class="text-[13px] font-semibold tracking-[0.09em] text-[#526A5A]">CURATED PROFESSIONAL LIBRARY</span><h1>Resources</h1><p>Books, papers, tools, courses, websites, and recommendations.</p></div><a class="inline-flex h-11 cursor-pointer items-center justify-center gap-2 rounded-md border border-transparent px-3.5 text-sm font-medium no-underline transition bg-[#526A5A] text-white hover:bg-[#293C32]" href="<?php echo e(route('admin.resources.create')); ?>"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
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
<?php endif; ?> Add Resource</a></section><div class="grid grid-cols-1 gap-3.5 md:grid-cols-2 xl:grid-cols-3"><?php $__currentLoopData = $resources; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $resource): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><article class="rounded-lg border border-[#EBEFEA] bg-white p-[18px] [&_h3]:font-['Newsreader'] [&_h3]:text-[22px] [&_h3]:font-medium [&_p]:text-[14px] [&_p]:leading-relaxed [&_p]:text-[#545F57] [&_a]:text-[#293C32] [&_a]:no-underline"><span class="inline-block rounded-full bg-[#E7ECE5] px-2 py-1 text-[12px] font-semibold tracking-[0.04em] text-[#3A5243]"><?php echo e(strtoupper(str_replace('_',' ',$resource->type))); ?></span><h3><?php echo e($resource->title); ?></h3><p><?php echo e($resource->description); ?></p><footer><span><?php echo e($resource->is_active?'Visible':'Hidden'); ?></span><a href="<?php echo e(route('admin.resources.edit',$resource)); ?>">Edit →</a></footer></article><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></div><div class="mt-[18px]"><?php echo e($resources->links()); ?></div><?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/ferdy/project-fl/vet-cms/backend/resources/views/admin/resources/index.blade.php ENDPATH**/ ?>