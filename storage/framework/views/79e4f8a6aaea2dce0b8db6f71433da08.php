<?php $__env->startSection('title', 'Categories · Content Studio'); ?>
<?php $__env->startSection('breadcrumb', 'Categories'); ?>
<?php $__env->startSection('content'); ?>
    <section class="mb-7 flex flex-col items-start justify-between gap-5 lg:flex-row lg:items-end">
        <div><span class="text-[10px] font-semibold tracking-[.1em] text-[#526A5A]">EDITORIAL TAXONOMY</span>
            <h1 class="mt-2 font-['Newsreader'] text-3xl font-medium text-[#293C32]">Categories</h1>
            <p class="mt-2 text-sm text-[#70766F]">Use broad, stable sections for your journal. Keep the list short so
                readers can browse it easily.</p>
        </div>
    </section>
    <div class="grid gap-5 xl:grid-cols-[minmax(0,1fr)_340px]">
        <section class="overflow-hidden rounded-2xl border border-[#E6EAE4] bg-white shadow-sm">
            <div
                class="grid grid-cols-[minmax(0,1fr)_90px_100px_100px] gap-3 border-b border-[#EEF1ED] bg-[#F7F9F6] px-5 py-3 text-[10px] font-semibold uppercase tracking-wide text-[#70766F]">
                <span>Category</span><span>Posts</span><span>Status</span><span></span>
            </div>
            <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div x-data="{ editing: false }" class="border-b border-[#EEF1ED] last:border-b-0">
                    <div
                        class="grid grid-cols-1 gap-3 px-5 py-4 md:grid-cols-[minmax(0,1fr)_90px_100px_100px] md:items-center">
                        <div class="min-w-0">
                            <div class="flex items-center gap-2"><span class="size-2.5 rounded-full"
                                    style="background:<?php echo e($category->accent_color ?: '#8FA58F'); ?>"></span><strong
                                    class="truncate text-sm text-[#293C32]"><?php echo e($category->name); ?></strong></div>
                            <p class="mt-1 truncate text-[11px] text-[#8A908A]">/<?php echo e($category->slug); ?> ·
                                <?php echo e(\Illuminate\Support\Str::limit($category->description, 70)); ?></p>
                        </div>
                        <span class="text-xs text-[#526A5A]"><?php echo e($category->posts_count); ?></span>
                        <span
                            class="w-fit rounded-full px-2.5 py-1 text-[9px] font-semibold <?php echo e($category->is_active ? 'bg-[#E4EFE5] text-[#355A40]' : 'bg-[#F0F1EF] text-[#777]'); ?>"><?php echo e($category->is_active ? 'ACTIVE' : 'HIDDEN'); ?></span>
                        <div class="flex items-center gap-2 md:justify-end"><button type="button" @click="editing=!editing"
                                class="text-[11px] font-medium text-[#526A5A]">Edit</button>
                            <form method="POST" action="<?php echo e(route('admin.categories.destroy', $category)); ?>"
                                onsubmit="return confirm('Delete this category? Existing posts will become uncategorized.')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button
                                    class="text-[11px] font-medium text-[#B24E42]">Delete</button></form>
                        </div>
                    </div>
                    <form x-show="editing" x-transition x-cloak method="POST"
                        action="<?php echo e(route('admin.categories.update', $category)); ?>"
                        class="grid gap-3 bg-[#FAFBF9] px-5 py-4 md:grid-cols-2"><?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                        <label class="text-[10px] font-medium uppercase text-[#70766F]">Name<input
                                class="mt-1 w-full rounded-lg border border-[#DDE2DF] bg-white px-3 py-2 text-xs"
                                name="name" value="<?php echo e($category->name); ?>" required></label>
                        <label class="text-[10px] font-medium uppercase text-[#70766F]">Slug<input
                                class="mt-1 w-full rounded-lg border border-[#DDE2DF] bg-white px-3 py-2 text-xs"
                                name="slug" value="<?php echo e($category->slug); ?>"></label>
                        <label class="text-[10px] font-medium uppercase text-[#70766F] md:col-span-2">Description
                            <textarea class="mt-1 min-h-20 w-full rounded-lg border border-[#DDE2DF] bg-white px-3 py-2 text-xs" name="description"><?php echo e($category->description); ?></textarea>
                        </label>
                        <label class="text-[10px] font-medium uppercase text-[#70766F]">Accent Color<input
                                class="mt-1 h-10 w-full rounded-lg border border-[#DDE2DF] bg-white px-2" type="color"
                                name="accent_color" value="<?php echo e($category->accent_color ?: '#8FA58F'); ?>"></label>
                        <label class="flex items-center gap-2 self-end pb-2 text-xs text-[#424843]"><input type="checkbox"
                                name="is_active" value="1" <?php if($category->is_active): echo 'checked'; endif; ?>> Visible on public site</label>
                        <div class="md:col-span-2 flex justify-end gap-2"><button type="button" @click="editing=false"
                                class="rounded-lg px-3 py-2 text-xs text-[#70766F]">Cancel</button><button
                                class="rounded-lg bg-[#526A5A] px-4 py-2 text-xs font-medium text-white">Save
                                Changes</button></div>
                    </form>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="p-10 text-center text-sm text-[#8A908A]">No categories yet.</div>
            <?php endif; ?>
        </section>
        <aside class="self-start rounded-2xl border border-[#E6EAE4] bg-white p-5 shadow-sm xl:sticky xl:top-24">
            <h2 class="text-sm font-semibold text-[#293C32]">Add Category</h2>
            <p class="mt-1 text-xs leading-5 text-[#70766F]">Examples: Clinical Cases, Cytology, Veterinary Education,
                Research Notes.</p>
            <form method="POST" action="<?php echo e(route('admin.categories.store')); ?>" class="mt-4 grid gap-3"><?php echo csrf_field(); ?>
                <label class="text-[10px] font-medium uppercase text-[#70766F]">Name<input
                        class="mt-1 w-full rounded-lg border border-[#DDE2DF] px-3 py-2.5 text-xs" name="name"
                        required></label>
                <label class="text-[10px] font-medium uppercase text-[#70766F]">Description
                    <textarea class="mt-1 min-h-24 w-full rounded-lg border border-[#DDE2DF] px-3 py-2.5 text-xs" name="description"></textarea>
                </label>
                <label class="text-[10px] font-medium uppercase text-[#70766F]">Accent Color<input
                        class="mt-1 h-10 w-full rounded-lg border border-[#DDE2DF] bg-white px-2" type="color"
                        name="accent_color" value="#8FA58F"></label>
                <label class="flex items-center gap-2 text-xs"><input type="checkbox" name="is_active" value="1"
                        checked> Visible on public site</label>
                <button
                    class="mt-1 rounded-lg bg-[#526A5A] px-4 py-2.5 text-xs font-medium text-white hover:bg-[#293C32]">Add
                    Category</button>
            </form>
        </aside>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/ferdy/project-fl/vet-cms/backend/resources/views/admin/categories/index.blade.php ENDPATH**/ ?>