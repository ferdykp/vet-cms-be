<?php $__env->startSection('title','Dashboard · Content Studio'); ?>
<?php $__env->startSection('breadcrumb','Workspace'); ?>
<?php $__env->startSection('content'); ?>
<section class="mb-7 flex flex-col items-start justify-between gap-6 lg:flex-row"><div><span class="text-[13px] font-semibold tracking-[0.09em] text-[#526A5A]">● CLINICAL EDITORIAL DESK</span><h1>Good morning, <?php echo e(str_starts_with(auth()->user()->name,'Dr.') ? auth()->user()->name : 'Dr. '.auth()->user()->name); ?>.</h1><p>Here is what is happening with your journal and writing studio today.</p></div><div class="flex flex-wrap items-center gap-2"><a class="inline-flex h-11 cursor-pointer items-center justify-center gap-2 rounded-md border border-transparent px-3.5 text-sm font-medium no-underline transition border-[#DDE2DF] bg-white text-[#293C32] hover:bg-[#F7F5EF]" target="_blank" rel="noopener noreferrer" href="<?php echo e(env('FRONTEND_URL','#')); ?>">↗ View Live Site</a><a class="inline-flex h-11 cursor-pointer items-center justify-center gap-2 rounded-md border border-transparent px-3.5 text-sm font-medium no-underline transition bg-[#526A5A] text-white hover:bg-[#293C32]" href="<?php echo e(route('admin.posts.create')); ?>"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'edit']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'edit']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?> Write Something</a></div></section>
<section class="mb-7 grid grid-cols-1 gap-3.5 sm:grid-cols-2 xl:grid-cols-4">
<?php $__currentLoopData = [['Published',$stats['published'],'articles'],['In Draft',$stats['drafts'],'stories'],['Taxonomy',$stats['categories'],'active topics'],['Media Vault',$stats['media'],'clinical assets']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="min-h-[105px] rounded-lg border border-[#EBEFEA] bg-white p-[18px] [&>span]:text-[13px] [&>span]:uppercase [&>span]:text-[#526A5A] [&>div]:mt-2 [&>div]:flex [&>div]:items-baseline [&>div]:gap-2 [&_strong]:font-['Newsreader'] [&_strong]:text-[34px] [&_strong]:font-medium [&_small]:text-[#545F57]"><span><?php echo e(strtoupper($s[0])); ?></span><div><strong><?php echo e($s[1]); ?></strong><small><?php echo e($s[2]); ?></small></div></div><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</section>
<div class="grid grid-cols-1 gap-7 xl:grid-cols-[minmax(0,1fr)_270px]"><div>
<section class="mb-[26px]"><div class="mb-3 flex items-center justify-between gap-3 [&_h2]:m-0 [&_h2]:text-lg [&_h3]:m-0 [&_h3]:text-lg [&_a]:text-[14px] [&_a]:text-[#526A5A] [&_a]:no-underline"><h2>⊙ Continue Writing</h2><a href="<?php echo e(route('admin.posts.index',['status'=>'draft'])); ?>">View all drafts (<?php echo e($stats['drafts']); ?>) →</a></div><div class="grid grid-cols-1 gap-3 md:grid-cols-2"><?php $__empty_1 = true; $__currentLoopData = $recentDrafts->take(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><article class="rounded-lg border border-[#EBEFEA] bg-white p-[18px] [&>div:first-child]:flex [&>div:first-child]:justify-between [&_h3]:text-sm [&_h3]:leading-relaxed [&_p]:text-sm [&_p]:leading-relaxed [&_p]:text-[#424843] [&_footer]:mt-5 [&_footer]:flex [&_footer]:justify-between [&_footer]:text-[14px] [&_footer]:text-[#545F57] [&_footer_a]:text-[#293C32] [&_footer_a]:no-underline"><div><span class="inline-block rounded-full bg-[#E7ECE5] px-2 py-1 text-[12px] font-semibold tracking-[0.04em] text-[#3A5243]"><?php echo e(strtoupper($post->category?->name ?? $post->type)); ?></span><small>• <?php echo e($post->updated_at->diffForHumans()); ?></small></div><h3><?php echo e($post->title); ?></h3><p><?php echo e(\Illuminate\Support\Str::limit($post->excerpt ?: 'Continue shaping this story and add your clinical perspective.',110)); ?></p><footer><span><?php echo e(number_format($post->reading_time ? $post->reading_time*200 : 0)); ?> words</span><a href="<?php echo e(route('admin.posts.edit',$post)); ?>">Continue →</a></footer></article><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><div class="p-10 text-center text-[#545F57]">No drafts yet. Start a new idea when inspiration arrives.</div><?php endif; ?></div></section>
<section class="mb-[26px]"><div class="mb-3 flex items-center justify-between gap-3 [&_h2]:m-0 [&_h2]:text-lg [&_h3]:m-0 [&_h3]:text-lg [&_a]:text-[14px] [&_a]:text-[#526A5A] [&_a]:no-underline"><h2><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'book']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'book']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?> Recently Published</h2><a href="<?php echo e(route('admin.posts.index',['status'=>'published'])); ?>">View Journal archive →</a></div><div class="overflow-hidden rounded-lg border border-[#EBEFEA] bg-white [&>article]:grid [&>article]:grid-cols-[60px_1fr] [&>article]:items-center [&>article]:gap-3.5 [&>article]:border-b [&>article]:border-[#EBEFEA] [&>article]:px-4 [&>article]:py-3.5 md:[&>article]:grid-cols-[76px_1fr_auto] [&>article:last-child]:border-b-0 [&_img]:h-[60px] [&_img]:w-[76px] [&_img]:rounded-md [&_img]:object-cover [&_h3]:my-1.5 [&_h3]:text-[15px] [&_p]:m-0 [&_p]:text-[14px] [&_p]:text-[#545F57] [&_a]:text-[14px] [&_a]:text-[#293C32] [&_a]:no-underline"><?php $__empty_1 = true; $__currentLoopData = $recentPublished->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><article><?php if($post->featuredMedia): ?><img src="<?php echo e($post->featuredMedia->url); ?>" alt=""><?php else: ?><div class="grid h-[60px] w-[76px] place-items-center rounded-md bg-[#E7ECE5] text-[#526A5A]">VET</div><?php endif; ?><div><div class="flex flex-wrap items-center gap-2 text-[13px] text-[#545F57]"><span class="inline-block rounded-full bg-[#E7ECE5] px-2 py-1 text-[12px] font-semibold tracking-[0.04em] text-[#3A5243]"><?php echo e(strtoupper($post->category?->name ?? 'JOURNAL')); ?></span><span><?php echo e(optional($post->published_at)->format('M d, Y')); ?></span><span>• <?php echo e($post->reading_time ?? 1); ?> min read</span></div><h3><?php echo e($post->title); ?></h3><p><?php echo e(\Illuminate\Support\Str::limit($post->excerpt,90)); ?></p></div><a href="<?php echo e(env('FRONTEND_URL','#')); ?>/journal/<?php echo e($post->slug); ?>" target="_blank" rel="noopener noreferrer">View Post ↗</a></article><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><div class="p-10 text-center text-[#545F57]">Published stories will appear here.</div><?php endif; ?></div></section>
<section class="flex flex-col justify-between gap-4 rounded-lg bg-[#EBEFEA] p-[22px] lg:flex-row lg:items-center [&>div>span]:text-[12px] [&>div>span]:font-semibold [&>div>span]:text-[#90563E] [&_h2]:my-2 [&_h2]:font-['Newsreader'] [&_h2]:text-[26px] [&_h2]:font-medium [&_p]:max-w-[500px] [&_p]:text-sm [&_p]:leading-relaxed [&_p]:text-[#424843]"><div><span>EDITORIAL INSIGHT</span><h2>Build your veterinary body of work</h2><p>Consistent publishing strengthens both professional credibility and the long-term usefulness of your knowledge archive.</p></div><div class="min-w-[135px] rounded-md bg-white p-3.5 text-center [&_small]:block [&_small]:text-[#545F57] [&_span]:block [&_span]:text-[#545F57] [&_strong]:block [&_strong]:font-['Newsreader'] [&_strong]:text-[28px] [&_strong]:font-medium"><small>Editorial rhythm</small><strong><?php echo e(max(1,$stats['published'])); ?></strong><span>published pieces</span></div></section>
</div><aside class="flex flex-col gap-[18px]"><div class="rounded-lg border border-[#EBEFEA] bg-white p-[18px]"><div class="mb-3 flex items-center justify-between gap-3 [&_h2]:m-0 [&_h2]:text-lg [&_h3]:m-0 [&_h3]:text-lg [&_a]:text-[14px] [&_a]:text-[#526A5A] [&_a]:no-underline"><h3>Quick Actions</h3><span>ϟ</span></div><?php $__currentLoopData = [['Write Long-form Article','Full essay or scientific guide','article'],['Record Clinical Case','Signalment, diagnosis, outcomes','clinical_case'],['Add Quick Note','Short clinical field observation','quick_note'],['Write a Story','Personal experience or reflection','story']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><a class="grid grid-cols-[30px_1fr_auto] items-center gap-2 py-2.5 text-[#181D1A] no-underline [&>span]:grid [&>span]:size-7 [&>span]:place-items-center [&>span]:rounded-lg [&>span]:bg-[#D2E9D0] [&_strong]:block [&_strong]:text-sm [&_small]:mt-0.5 [&_small]:block [&_small]:text-[13px] [&_small]:text-[#545F57]" href="<?php echo e(route('admin.posts.create',['type'=>$a[2]])); ?>"><span><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
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
<?php endif; ?></span><div><strong><?php echo e($a[0]); ?></strong><small><?php echo e($a[1]); ?></small></div><i>›</i></a><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><a class="grid grid-cols-[30px_1fr_auto] items-center gap-2 py-2.5 text-[#181D1A] no-underline [&>span]:grid [&>span]:size-7 [&>span]:place-items-center [&>span]:rounded-lg [&>span]:bg-[#D2E9D0] [&_strong]:block [&_strong]:text-sm [&_small]:mt-0.5 [&_small]:block [&_small]:text-[13px] [&_small]:text-[#545F57]" href="<?php echo e(route('admin.media.index')); ?>"><span><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'image']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'image']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?></span><div><strong>Upload Clinical Media</strong><small>Histology, ultrasounds, radiographs</small></div><i>›</i></a><a class="grid grid-cols-[30px_1fr_auto] items-center gap-2 py-2.5 text-[#181D1A] no-underline [&>span]:grid [&>span]:size-7 [&>span]:place-items-center [&>span]:rounded-lg [&>span]:bg-[#D2E9D0] [&_strong]:block [&_strong]:text-sm [&_small]:mt-0.5 [&_small]:block [&_small]:text-[13px] [&_small]:text-[#545F57]" href="<?php echo e(route('admin.profile.edit')); ?>"><span><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'user']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'user']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?></span><div><strong>Update Public Bio</strong><small>Credentials & affiliations</small></div><i>›</i></a></div><div class="rounded-lg border border-[#EBEFEA] bg-white p-[18px] [&>p]:text-[13px] [&>p]:text-[#545F57] [&>a]:mt-2 [&>a]:block [&>a]:rounded-md [&>a]:bg-[#F0F5F0] [&>a]:p-2.5 [&>a]:text-[#181D1A] [&>a]:no-underline [&_strong]:block [&_strong]:text-[14px] [&_small]:mt-1 [&_small]:block [&_small]:text-[12px] [&_small]:text-[#424843]"><h3>Writing Templates</h3><p>Structured starting blueprints designed for veterinary discourse.</p><a href="<?php echo e(route('admin.posts.create',['type'=>'clinical_case'])); ?>"><strong>Clinical Case Review</strong><small>Structured for anamnesis, differential list, treatment pathways, and reflection.</small></a><a href="<?php echo e(route('admin.posts.create',['type'=>'article'])); ?>"><strong>Pet Owner Education Guide</strong><small>Accessible language tone, symptom breakdown, home care tips, and FAQ blocks.</small></a><a href="<?php echo e(route('admin.posts.create',['type'=>'quick_note'])); ?>"><strong>Conference Synthesis Note</strong><small>Succinct takeaways from academic symposiums and field relevance.</small></a></div></aside></div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/ferdy/project-fl/vet-cms/backend/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>