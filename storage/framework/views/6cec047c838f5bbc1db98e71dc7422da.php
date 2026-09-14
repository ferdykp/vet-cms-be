<?php $__env->startSection('title', 'Journal · Content Studio'); ?>
<?php $__env->startSection('breadcrumb', 'Journal'); ?>
<?php $__env->startSection('content'); ?>
    <section class="flex flex-col items-start justify-between gap-6 mb-7 lg:flex-row">
        <div><span class="text-[13px] font-semibold tracking-[0.09em] text-[#526A5A]">JOURNAL & KNOWLEDGE ARCHIVE</span>
            <h1>Journal</h1>
            <p>Write, organize, and publish clinical knowledge, reflections, and stories.</p>
        </div><a
            class="inline-flex h-11 cursor-pointer items-center justify-center gap-2 rounded-md border border-transparent px-3.5 text-sm font-medium no-underline transition bg-[#526A5A] text-white hover:bg-[#293C32]"
            href="<?php echo e(route('admin.posts.create')); ?>"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
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
<?php endif; ?> New Content</a>
    </section>
    <div class="mb-4 rounded-lg border border-[#EBEFEA] bg-white p-2.5">
        <form
            class="flex flex-wrap items-center gap-2 [&_input]:rounded-md [&_input]:border [&_input]:border-[#DDE2DF] [&_input]:bg-white [&_input]:px-2.5 [&_input]:py-2 [&_input]:text-sm [&_input]:outline-none [&_select]:rounded-md [&_select]:border [&_select]:border-[#DDE2DF] [&_select]:bg-white [&_select]:px-2.5 [&_select]:py-2 [&_select]:text-sm [&_select]:outline-none [&_input:focus]:border-[#526A5A] [&_select:focus]:border-[#526A5A]">
            <input class="min-w-[220px] sm:min-w-[280px]" name="search" value="<?php echo e(request('search')); ?>"
                placeholder="Search journal…"><select name="status">
                <option value="all">All statuses</option>
                <?php $__currentLoopData = ['draft', 'scheduled', 'published', 'archived']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($v); ?>" <?php if(request('status') === $v): echo 'selected'; endif; ?>><?php echo e(ucfirst($v)); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <select name="type">
                <option value="all">All formats</option>
                <?php $__currentLoopData = ['article', 'clinical_case', 'quick_note', 'story']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($v); ?>" <?php if(request('type') === $v): echo 'selected'; endif; ?>>
                        <?php echo e(ucwords(str_replace('_', ' ', $v))); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <select name="category_id">
                <option value="">All categories</option>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->id); ?>" <?php if((string) request('category_id') === (string) $category->id): echo 'selected'; endif; ?>><?php echo e($category->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <button
                class="inline-flex h-11 cursor-pointer items-center justify-center gap-2 rounded-md border border-transparent px-3.5 text-sm font-medium no-underline transition border-[#DDE2DF] bg-white text-[#293C32] hover:bg-[#F7F5EF]">Filter</button>
        </form>
    </div>
    <div class="overflow-hidden rounded-lg border border-[#EBEFEA] bg-white">
        <div
            class="hidden grid-cols-[minmax(260px,1.6fr)_.8fr_.6fr_.7fr_1fr] items-center gap-[15px] bg-[#F0F5F0] px-4 py-3 text-[12px] uppercase tracking-[0.06em] text-[#545F57] md:grid">
            <span>Title</span><span>Category</span><span>Status</span><span>Updated</span><span></span>
        </div>
        <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div
                class="grid grid-cols-1 items-center gap-2 border-t border-[#EBEFEA] px-4 py-3 text-sm md:grid-cols-[minmax(260px,1.6fr)_.8fr_.6fr_.7fr_1fr] md:gap-[15px] [&_small]:mt-1 [&_small]:block [&_small]:text-[#545F57]">
                <div
                    class="flex items-center gap-2.5 [&_img]:h-11 [&_img]:w-11 [&_img]:rounded [&_img]:object-cover [&_a]:block [&_a]:font-semibold [&_a]:text-[#181D1A] [&_a]:no-underline [&_small]:mt-1 [&_small]:block [&_small]:text-[#545F57]">
                    <?php if($post->featuredMedia): ?>
                    <img src="<?php echo e($post->featuredMedia->url); ?>" alt=""><?php else: ?><div
                            class="grid h-11 w-11 place-items-center rounded bg-[#E7ECE5]"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'file']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'file']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?></div>
                    <?php endif; ?>
                    <div>
                        <a
                            href="<?php echo e(route('admin.posts.edit', $post)); ?>"><?php echo e($post->title); ?></a><small><?php echo e(ucwords(str_replace('_', ' ', $post->type))); ?></small>
                    </div>
                </div><span><?php echo e($post->category?->name ?? 'Uncategorized'); ?></span><span><span
                        class="rounded-full px-2 py-1 text-[12px] font-semibold <?php echo e(match ($post->status) {'published' => 'bg-[#526A5A] text-white','scheduled' => 'bg-[#FFF0DC] text-[#8B5D21]','archived' => 'bg-[#EFEFEF] text-[#777]',default => 'bg-[#E7ECE5] text-[#3A5243]'}); ?>"><?php echo e(strtoupper($post->status)); ?></span></span><span><?php echo e($post->updated_at->diffForHumans()); ?></span>
                <div
                    class="flex items-center gap-2 md:justify-end [&_a]:text-[13px] [&_a]:font-medium [&_a]:text-[#526A5A] [&_a]:no-underline [&_button]:border-0 [&_button]:bg-transparent [&_button]:text-[13px] [&_button]:font-medium [&_button]:text-[#526A5A]">
                    <a href="<?php echo e(route('admin.posts.edit', $post)); ?>">Edit</a>
                    <form method="POST" action="<?php echo e(route('admin.posts.duplicate', $post)); ?>">
                        <?php echo csrf_field(); ?><button>Duplicate</button></form>
                    <form method="POST" action="<?php echo e(route('admin.posts.destroy', $post)); ?>"
                        onsubmit="return confirm('Move this content to trash?')"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button
                            class="text-[#B24E42]!">Delete</button></form>
                </div>
        </div><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><div class="p-10 text-center text-[#545F57]">
                <h3>Your journal is ready for its first story.</h3>
                <p>Start with a clinical case, educational article, quick note, or personal story.</p><a
                    class="inline-flex h-11 cursor-pointer items-center justify-center gap-2 rounded-md border border-transparent px-3.5 text-sm font-medium no-underline transition bg-[#526A5A] text-white hover:bg-[#293C32]"
                    href="<?php echo e(route('admin.posts.create')); ?>">Write Your First Post</a>
            </div>
        <?php endif; ?>
    </div>
    <div class="mt-[18px]"><?php echo e($posts->links()); ?></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/ferdy/project-fl/vet-cms/backend/resources/views/admin/posts/index.blade.php ENDPATH**/ ?>