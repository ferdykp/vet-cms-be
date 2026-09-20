<div class="rounded-2xl border border-[#E6EAE4] bg-white p-5 shadow-sm" x-data="{adding:false}">
    <div class="mb-3 flex items-center justify-between"><h3 class="text-sm font-semibold text-[#293C32]"><?php echo e($title); ?></h3><button type="button" @click="adding=!adding" class="rounded-lg bg-[#E7ECE5] px-3 py-1.5 text-[14px] font-medium text-[#526A5A] hover:bg-[#DDE7DC]">+ Add</button></div>
    <div class="divide-y divide-[#EEF1ED]">
        <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="flex items-start justify-between gap-4 py-3 first:pt-0">
                <div class="min-w-0"><strong class="block truncate text-sm text-[#293C32]"><?php echo e(data_get($item,$primary)); ?></strong><span class="mt-1 block truncate text-[13px] text-[#545F57]"><?php echo e(data_get($item,$secondary) ?: '—'); ?></span></div>
                <form method="POST" action="<?php echo e(route('admin.'.$route.'.destroy',$item)); ?>" onsubmit="return confirm('Remove this entry?')"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button class="text-[13px] font-medium text-[#B24E42]">Remove</button></form>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="py-4 text-sm text-[#5B675E]">No <?php echo e(strtolower($title)); ?> added yet.</p>
        <?php endif; ?>
    </div>
    <form x-show="adding" x-transition x-cloak method="POST" action="<?php echo e(route('admin.'.$route.'.store')); ?>" class="mt-4 grid gap-3 border-t border-[#EEF1ED] pt-4 md:grid-cols-2">
        <?php echo csrf_field(); ?>
        <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$name,$label,$type]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <label class="text-[13px] font-medium uppercase tracking-wide text-[#545F57] <?php echo e($type==='textarea' ? 'md:col-span-2' : ''); ?>"><?php echo e($label); ?>

                <?php if($type==='textarea'): ?><textarea name="<?php echo e($name); ?>" class="mt-1 min-h-20 w-full rounded-lg border border-[#DDE2DF] px-3 py-2 text-sm outline-none focus:border-[#8FA58F]"></textarea>
                <?php else: ?><input type="<?php echo e($type); ?>" name="<?php echo e($name); ?>" class="mt-1 w-full rounded-lg border border-[#DDE2DF] px-3 py-2 text-sm outline-none focus:border-[#8FA58F]" <?php if(in_array($name,['degree','institution','position','organization','name','title','event_name'])): ?> required <?php endif; ?>><?php endif; ?>
            </label>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <div class="md:col-span-2 flex justify-end gap-2"><button type="button" @click="adding=false" class="rounded-lg px-3 py-2 text-sm text-[#545F57]">Cancel</button><button class="rounded-lg bg-[#526A5A] px-4 py-2 text-sm font-medium text-white">Add <?php echo e(rtrim($title,'s')); ?></button></div>
    </form>
</div>
<?php /**PATH /Users/ferdy/project-fl/vet-cms/backend/resources/views/admin/profile/_credential-card.blade.php ENDPATH**/ ?>