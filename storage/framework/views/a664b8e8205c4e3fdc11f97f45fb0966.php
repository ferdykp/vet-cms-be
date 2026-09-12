<?php $__env->startSection('title','Website Settings · Content Studio'); ?>
<?php $__env->startSection('breadcrumb','Website Settings'); ?>
<?php $__env->startSection('content'); ?>
<section class="mb-7"><span class="text-[10px] font-semibold tracking-[.1em] text-[#526A5A]">GLOBAL SITE CONFIGURATION</span><h1 class="mt-2 font-['Newsreader'] text-3xl font-medium text-[#293C32]">Website Settings</h1><p class="mt-2 max-w-2xl text-sm leading-6 text-[#70766F]">Global defaults used by the public frontend. Content itself is still managed from Journal, Profile, Resources, and Pages.</p></section>
<form method="POST" action="<?php echo e(route('admin.settings.update')); ?>" class="space-y-5"><?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?> <?php ($i=0); ?>
<?php $__empty_1 = true; $__currentLoopData = $settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group => $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
<section class="rounded-2xl border border-[#E6EAE4] bg-white p-5 shadow-sm sm:p-6">
  <div class="mb-5 border-b border-[#EEF1ED] pb-3"><h2 class="text-sm font-semibold capitalize text-[#293C32]"><?php echo e(str_replace('_',' ',$group)); ?></h2><p class="mt-1 text-xs text-[#8A908A]"><?php echo e(match($group) { 'general' => 'Basic site identity and contact details.', 'publishing' => 'Defaults for journal presentation.', 'seo' => 'Search engine defaults for the public site.', 'contact' => 'Public contact form behavior.', default => 'Configuration values for this section.' }); ?></p></div>
  <div class="grid gap-5 md:grid-cols-2">
  <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php ($pretty = str($setting->key)->afterLast('.')->replace('_',' ')->title()); ?>
    <div class="<?php echo e($setting->type==='text' ? 'md:col-span-2' : ''); ?>">
      <input type="hidden" name="settings[<?php echo e($i); ?>][group]" value="<?php echo e($setting->group); ?>"><input type="hidden" name="settings[<?php echo e($i); ?>][key]" value="<?php echo e($setting->key); ?>"><input type="hidden" name="settings[<?php echo e($i); ?>][type]" value="<?php echo e($setting->type); ?>"><input type="hidden" name="settings[<?php echo e($i); ?>][is_public]" value="<?php echo e($setting->is_public ? 1 : 0); ?>">
      <?php if($setting->type==='boolean'): ?>
        <label class="flex items-start justify-between gap-5 rounded-xl border border-[#EEF1ED] bg-[#FAFBF9] p-4"><span><strong class="block text-xs font-medium text-[#293C32]"><?php echo e($pretty); ?></strong><small class="mt-1 block text-[10px] leading-4 text-[#8A908A]"><?php echo e($setting->key); ?></small></span><span class="relative"><input type="hidden" name="settings[<?php echo e($i); ?>][value]" value="0"><input type="checkbox" name="settings[<?php echo e($i); ?>][value]" value="1" class="size-4 accent-[#526A5A]" <?php if($setting->typed_value): echo 'checked'; endif; ?>></span></label>
      <?php elseif($setting->type==='text'): ?>
        <label class="block text-xs font-medium text-[#424843]"><?php echo e($pretty); ?><textarea name="settings[<?php echo e($i); ?>][value]" class="mt-1 min-h-24 w-full rounded-lg border border-[#DDE2DF] bg-white px-3 py-2.5 text-sm outline-none focus:border-[#8FA58F]"><?php echo e($setting->value); ?></textarea><small class="mt-1 block text-[10px] text-[#8A908A]"><?php echo e($setting->key); ?></small></label>
      <?php else: ?>
        <label class="block text-xs font-medium text-[#424843]"><?php echo e($pretty); ?><input name="settings[<?php echo e($i); ?>][value]" type="<?php echo e(in_array($setting->type,['integer','float']) ? 'number' : 'text'); ?>" value="<?php echo e($setting->value); ?>" class="mt-1 w-full rounded-lg border border-[#DDE2DF] bg-white px-3 py-2.5 text-sm outline-none focus:border-[#8FA58F]"><small class="mt-1 block text-[10px] text-[#8A908A]"><?php echo e($setting->key); ?></small></label>
      <?php endif; ?>
    </div>
    <?php ($i++); ?>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
</section>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
<div class="rounded-2xl border border-dashed border-[#C9D3C9] bg-[#F7FAF7] p-10 text-center"><h2 class="font-['Newsreader'] text-2xl text-[#293C32]">No website settings yet</h2><p class="mt-2 text-sm text-[#70766F]">Run <code class="rounded bg-white px-1.5 py-1">php artisan db:seed --class=WebsiteSettingSeeder</code> once.</p></div>
<?php endif; ?>
<?php if($i): ?><div class="sticky bottom-4 z-20 flex justify-end"><button class="rounded-xl bg-[#526A5A] px-5 py-3 text-sm font-medium text-white shadow-lg shadow-[#526A5A]/15 hover:bg-[#293C32]">Save Website Settings</button></div><?php endif; ?>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/ferdy/project-fl/vet-cms/backend/resources/views/admin/settings/index.blade.php ENDPATH**/ ?>