<?php $__env->startSection('title','Navigation · Content Studio'); ?>
<?php $__env->startSection('breadcrumb','Navigation'); ?>
<?php $__env->startSection('content'); ?>
<section class="mb-7"><span class="text-[13px] font-semibold tracking-[.1em] text-[#526A5A]">PUBLIC MENU STRUCTURE</span><h1 class="mt-2 font-['Newsreader'] text-3xl font-medium text-[#293C32]">Navigation</h1><p class="mt-2 max-w-2xl text-sm leading-6 text-[#545F57]">Keep the public navigation short and predictable. Home, Journal, About, Resources, and Contact are usually enough.</p></section>
<div class="grid gap-5 xl:grid-cols-[minmax(0,1fr)_340px]">
<section class="rounded-2xl border border-[#E6EAE4] bg-white p-5 shadow-sm">
  <div class="mb-4 flex items-center justify-between"><h2 class="text-sm font-semibold text-[#293C32]">Menu items</h2><span class="text-[13px] text-[#5B675E]">Edit visibility, URL, and order</span></div>
  <div class="space-y-2">
  <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div x-data="{editing:false}" class="rounded-xl border border-[#EEF1ED] bg-[#FCFDFC]">
      <div class="flex items-center justify-between gap-4 px-4 py-3"><div class="min-w-0"><div class="flex items-center gap-2"><span class="text-[#5B675E]"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'settings']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'settings']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?></span><strong class="truncate text-sm text-[#293C32]"><?php echo e($item->label); ?></strong><?php if(!$item->is_active): ?><span class="rounded-full bg-[#F0F1EF] px-2 py-0.5 text-[12px] text-[#777]">Hidden</span><?php endif; ?></div><p class="mt-1 text-[13px] text-[#5B675E]"><?php echo e($item->type); ?> · <?php echo e($item->url ?: 'resolved automatically'); ?> · order <?php echo e($item->sort_order); ?></p></div><div class="flex gap-3"><button @click="editing=!editing" type="button" class="text-[14px] font-medium text-[#526A5A]">Edit</button><form method="POST" action="<?php echo e(route('admin.navigation.destroy',$item)); ?>" onsubmit="return confirm('Delete this menu item and its children?')"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button class="text-[14px] text-[#B24E42]">Delete</button></form></div></div>
      <form x-show="editing" x-transition x-cloak method="POST" action="<?php echo e(route('admin.navigation.update',$item)); ?>" class="grid gap-3 border-t border-[#EEF1ED] bg-white px-4 py-4 md:grid-cols-2"><?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
        <label class="text-[13px] font-medium uppercase text-[#545F57]">Label<input class="mt-1 w-full rounded-lg border border-[#DDE2DF] px-3 py-2 text-sm" name="label" value="<?php echo e($item->label); ?>" required></label>
        <label class="text-[13px] font-medium uppercase text-[#545F57]">Type<select class="mt-1 w-full rounded-lg border border-[#DDE2DF] px-3 py-2 text-sm" name="type"><?php $__currentLoopData = ['home','journal','page','category','external']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($v); ?>" <?php if($item->type===$v): echo 'selected'; endif; ?>><?php echo e(ucfirst($v)); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select></label>
        <label class="text-[13px] font-medium uppercase text-[#545F57]">URL<input class="mt-1 w-full rounded-lg border border-[#DDE2DF] px-3 py-2 text-sm" name="url" value="<?php echo e($item->url); ?>" placeholder="/about or https://..."></label>
        <label class="text-[13px] font-medium uppercase text-[#545F57]">Order<input class="mt-1 w-full rounded-lg border border-[#DDE2DF] px-3 py-2 text-sm" type="number" min="0" name="sort_order" value="<?php echo e($item->sort_order); ?>"></label>
        <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="is_active" value="1" <?php if($item->is_active): echo 'checked'; endif; ?>> Visible</label>
        <div class="flex justify-end"><button class="rounded-lg bg-[#526A5A] px-4 py-2 text-sm font-medium text-white">Save</button></div>
      </form>
      <?php if($item->children->isNotEmpty()): ?><div class="border-t border-[#EEF1ED] px-4 pb-3 pt-2"><?php $__currentLoopData = $item->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><div class="flex justify-between py-2 pl-5 text-[14px]"><span class="text-[#424843]">↳ <?php echo e($child->label); ?></span><span class="text-[#5B675E]"><?php echo e($child->type); ?></span></div><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></div><?php endif; ?>
    </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><div class="py-10 text-center text-sm text-[#5B675E]">No navigation items yet.</div><?php endif; ?>
  </div>
</section>
<aside class="self-start rounded-2xl border border-[#E6EAE4] bg-white p-5 shadow-sm xl:sticky xl:top-24"><h2 class="text-sm font-semibold text-[#293C32]">Add menu item</h2><p class="mt-1 text-sm leading-5 text-[#545F57]">For standard pages, use a relative URL such as <code>/about</code>.</p><form method="POST" action="<?php echo e(route('admin.navigation.store')); ?>" class="mt-4 grid gap-3"><?php echo csrf_field(); ?>
<label class="text-[13px] font-medium uppercase text-[#545F57]">Label<input class="mt-1 w-full rounded-lg border border-[#DDE2DF] px-3 py-2.5 text-sm" name="label" required></label>
<label class="text-[13px] font-medium uppercase text-[#545F57]">Type<select class="mt-1 w-full rounded-lg border border-[#DDE2DF] px-3 py-2.5 text-sm" name="type"><?php $__currentLoopData = ['home','journal','page','category','external']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($v); ?>"><?php echo e(ucfirst($v)); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select></label>
<label class="text-[13px] font-medium uppercase text-[#545F57]">URL<input class="mt-1 w-full rounded-lg border border-[#DDE2DF] px-3 py-2.5 text-sm" name="url" placeholder="/about"></label>
<label class="text-[13px] font-medium uppercase text-[#545F57]">Order<input class="mt-1 w-full rounded-lg border border-[#DDE2DF] px-3 py-2.5 text-sm" type="number" min="0" name="sort_order" value="0"></label>
<label class="flex items-center gap-2 text-sm"><input type="checkbox" name="is_active" value="1" checked> Visible</label><button class="rounded-lg bg-[#526A5A] px-4 py-2.5 text-sm font-medium text-white">Add Menu Item</button></form></aside>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/ferdy/project-fl/vet-cms/backend/resources/views/admin/navigation/index.blade.php ENDPATH**/ ?>