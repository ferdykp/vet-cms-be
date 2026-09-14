<?php
$isEdit = isset($post) && $post;
$currentType = old('type', $isEdit ? $post->type : ($type ?? request('type','article')));
$content = old('content', $isEdit ? ($post->content ?? []) : []);
$blocks = $content['blocks'] ?? $content ?? [];
?>
<form @submit="serialize()" id="post-editor-form" method="POST" action="<?php echo e($isEdit ? route('admin.posts.update',$post) : route('admin.posts.store')); ?>" class="min-h-[calc(100vh-64px)]" x-data="postEditor(<?php echo \Illuminate\Support\Js::from($blocks)->toHtml() ?>, <?php echo \Illuminate\Support\Js::from(old('status', $isEdit ? $post->status : 'draft'))->toHtml() ?>)">
<?php echo csrf_field(); ?> <?php if($isEdit): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>
<input type="hidden" name="type" value="<?php echo e($currentType); ?>">
<input type="hidden" name="status" x-model="status">

<div id="serialized-content"></div>
<div class="sticky top-16 z-30 flex min-h-[52px] flex-wrap items-center justify-between gap-2 border-b border-[#E5E9E4] bg-[#F7F5EF]/95 px-3.5 py-2 backdrop-blur lg:px-7"><div class="flex items-center gap-3 text-sm"><a class="font-medium text-[#526A5A] no-underline hover:text-[#293C32]" href="<?php echo e(route('admin.posts.index')); ?>">← Journal</a><span class="h-4 w-px bg-[#DDE2DF]"></span><span class="inline-flex items-center gap-1.5 text-[#545F57]"><i class="size-2 rounded-full" :class="dirty ? 'bg-[#C9866B]' : 'bg-[#8FA58F]'"></i><span x-text="saveLabel"></span></span></div><div class="flex flex-wrap items-center gap-2"><button type="button" class="inline-flex h-11 cursor-pointer items-center justify-center gap-2 rounded-md border border-transparent px-3.5 text-sm font-medium no-underline transition border-[#DDE2DF] bg-white text-[#293C32] hover:bg-[#F7F5EF] h-11" @click="previewMode=true"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'eye']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'eye']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?> Preview</button><button type="submit" class="inline-flex h-11 cursor-pointer items-center justify-center gap-2 rounded-md border border-transparent px-3.5 text-sm font-medium no-underline transition border-[#DDE2DF] bg-white text-[#293C32] hover:bg-[#F7F5EF] h-11" @click="status='draft'">Save Draft</button><button type="submit" class="inline-flex h-11 cursor-pointer items-center justify-center gap-2 rounded-md border border-transparent px-3.5 text-sm font-medium no-underline transition bg-[#526A5A] text-white hover:bg-[#293C32] h-11" @click="if(status==='draft') status='published'" x-text="status==='scheduled' ? 'Schedule article' : status==='archived' ? 'Save archive' : 'Publish article'">Publish article</button><button type="button" class="grid size-11 cursor-pointer place-items-center rounded-md border border-[#DDE2DF] bg-white" @click="settingsOpen=!settingsOpen" aria-label="Toggle article settings" :aria-expanded="settingsOpen"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
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
<?php endif; ?></button></div></div>
<div class="grid grid-cols-1 gap-7 px-3.5 py-5 lg:px-7" :class="settingsOpen ? 'xl:grid-cols-[minmax(0,1fr)_320px]' : 'xl:grid-cols-1'"><section class="mx-auto w-full max-w-[820px]">
<div class="mb-4 flex flex-wrap items-center gap-2 text-[13px] uppercase tracking-[0.08em] text-[#526A5A]"><span class="inline-block rounded-full bg-[#E7ECE5] px-2 py-1 text-[12px] font-semibold tracking-[0.04em] text-[#3A5243]"><?php echo e(strtoupper(str_replace('_',' ',$currentType))); ?></span><?php if($isEdit): ?><span>ID #<?php echo e(str_pad($post->id,4,'0',STR_PAD_LEFT)); ?></span><?php endif; ?></div>
<textarea class="w-full resize-none border-0 bg-transparent font-['Newsreader'] text-[34px] font-medium leading-tight tracking-[-0.02em] text-[#252A27] outline-none md:text-[48px]" name="title" placeholder="Add title…" required><?php echo e(old('title',$isEdit?$post->title:'')); ?></textarea>
<textarea class="mt-3 w-full resize-none border-0 bg-transparent text-sm leading-relaxed text-[#545F57] outline-none" name="excerpt" placeholder="Add a short description…"><?php echo e(old('excerpt',$isEdit?$post->excerpt:'')); ?></textarea>
<div class="my-5 flex items-center gap-2 text-sm text-[#545F57]"><div class="grid size-7 place-items-center rounded-full bg-[#526A5A] text-[14px] text-white"><?php echo e(strtoupper(substr(auth()->user()->name,0,1))); ?></div><span><?php echo e(auth()->user()->name); ?></span><span>•</span><span><?php echo e($isEdit ? ($post->reading_time ?? 1).' min read' : 'New draft'); ?></span></div>
<?php if($currentType==='clinical_case'): ?><div class="my-5 rounded-lg border border-[#E8D7C8] bg-[#FFF8F0] p-4 text-sm leading-relaxed text-[#6F5848]"><strong><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'award']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'award']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?> Signalment & Compliance Reminder</strong><p>Before publishing a clinical case, remove owner names, unique accession numbers, clinic identifiers, and identifying metadata from uploaded imagery.</p></div><?php endif; ?>
<div class="space-y-3" id="block-editor">
<template x-for="(block,index) in blocks" :key="block.uid"><div data-editor-block class="group relative rounded-xl border border-transparent bg-white p-4 shadow-[0_1px_0_rgba(41,60,50,0.03)] transition hover:border-[#DDE2DF] hover:shadow-sm" :data-type="block.type"><div class="mb-3 flex justify-end gap-1 text-[#545F57]"><button type="button" class="grid size-10 place-items-center rounded hover:bg-[#E7ECE5]" @click="moveBlock(index,-1)" title="Move up"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'up']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'up']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?></button><button type="button" class="grid size-10 place-items-center rounded hover:bg-[#E7ECE5]" @click="moveBlock(index,1)" title="Move down"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'down']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'down']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?></button><button type="button" class="grid size-10 place-items-center rounded text-[#B24E42] hover:bg-[#FFF0EE]" @click="removeBlock(index)" title="Remove block" aria-label="Close"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'close']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'close']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?></button></div><template x-if="block.type==='heading'"><input x-model="block.data.text" class="w-full border-0 bg-transparent font-['Newsreader'] text-3xl font-medium outline-none" placeholder="Section heading"></template><template x-if="block.type==='quote'"><textarea x-model="block.data.text" class="min-h-[100px] w-full resize-y border-l-4 border-[#8FA58F] bg-transparent pl-5 font-['Newsreader'] text-2xl italic leading-relaxed outline-none" placeholder="Clinical citation or quote"></textarea></template><template x-if="block.type==='callout'"><div class="grid gap-2 rounded-lg bg-[#E7ECE5] p-4 [&_input]:border-0 [&_input]:bg-transparent [&_input]:font-semibold [&_input]:outline-none [&_textarea]:min-h-[80px] [&_textarea]:border-0 [&_textarea]:bg-transparent [&_textarea]:outline-none"><input x-model="block.data.title" placeholder="Callout title"><textarea x-model="block.data.text" placeholder="Highlighted note"></textarea></div></template><template x-if="block.type==='checklist'"><textarea x-model="block.data.text" class="min-h-[100px] w-full resize-y border-0 bg-transparent font-['Newsreader'] text-lg leading-8 outline-none" placeholder="One checklist item per line"></textarea></template><template x-if="block.type==='image'"><div class="grid gap-2 rounded-lg bg-[#F0F5F0] p-4 [&_input]:rounded-md [&_input]:border [&_input]:border-[#DDE2DF] [&_input]:bg-white [&_input]:p-2 [&_input]:text-sm"><input x-model="block.data.url" placeholder="Image URL"><input x-model="block.data.caption" placeholder="Caption"><input x-model="block.data.alt" placeholder="Image description (alt text)"></div></template><template x-if="block.type==='list'"><div class="space-y-2"><p class="text-sm text-[#545F57]">List items</p><template x-for="(item,itemIndex) in (block.data.items || [])"><textarea class="w-full rounded-lg border border-[#DDE2DF] p-3 text-base" :value="typeof item === 'object' ? item.content || item.text || '' : item" @input="if(typeof item === 'object') { if('content' in item) item.content=$event.target.value; else item.text=$event.target.value; } else block.data.items[itemIndex]=$event.target.value"></textarea></template></div></template><template x-if="block.type==='paragraph'"><textarea x-model="block.data.text" class="min-h-[100px] w-full resize-y border-0 bg-transparent font-['Newsreader'] text-lg leading-8 outline-none" placeholder="Start writing…"></textarea></template></div></template>
<div class="relative flex flex-wrap items-center justify-center gap-3 py-3 text-sm text-[#545F57]"><button type="button" class="grid size-8 place-items-center rounded-full border border-[#DDE2DF] bg-white text-[#526A5A] shadow-sm" @click="commandOpen=!commandOpen" aria-label="Add content block" :aria-expanded="commandOpen"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
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
<?php endif; ?></button><span>Add text, images, quotes, or a checklist</span><div class="absolute top-12 z-20 grid w-[260px] gap-1 rounded-lg border border-[#DDE2DF] bg-white p-2 shadow-xl [&_button]:rounded-md [&_button]:border-0 [&_button]:bg-transparent [&_button]:px-3 [&_button]:py-2 [&_button]:text-left [&_button]:text-sm [&_button:hover]:bg-[#E7ECE5]" x-show="commandOpen" x-cloak><?php $__currentLoopData = [['paragraph','☷','Paragraph','Plain clinical text'],['heading','T','Heading 2','Major section break'],['callout','⚕','Case Callout','Highlighted notice'],['image','▧','Clinical Image','Microscopy or photography'],['quote','❞','Clinical Citation','Peer study quote'],['checklist','✓','Evaluation Checklist','Diagnostic steps']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cmd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><button type="button" @click="addBlock('<?php echo e($cmd[0]); ?>'); commandOpen=false"><span><?php echo e($cmd[1]); ?></span><div><strong><?php echo e($cmd[2]); ?></strong><small><?php echo e($cmd[3]); ?></small></div></button><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></div></div>
</div>
</section>
<aside class="self-start rounded-xl border border-[#E2E8E1] bg-white p-4 shadow-sm xl:sticky xl:top-[132px]" x-show="settingsOpen" x-transition.opacity x-cloak><div class="mb-4 flex items-center justify-between border-b border-[#EEF1ED] pb-3"><div><p class="m-0 text-[13px] font-semibold uppercase tracking-[.08em] text-[#8FA58F]">Publishing</p><h3 class="m-0 mt-1 text-sm font-semibold">Article Settings</h3></div><button type="button" class="grid size-8 place-items-center rounded-md text-[#545F57] hover:bg-[#F0F5F0]" @click="settingsOpen=false" aria-label="Close"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'close']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'close']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?></button></div><div class="mb-4 grid grid-cols-3 rounded-md bg-[#F0F5F0] p-1 [&_button]:rounded [&_button]:border-0 [&_button]:bg-transparent [&_button]:px-2 [&_button]:py-2 [&_button]:text-[13px] [&_button]:font-medium [&_button]:text-[#545F57]"><button type="button" :class="{'bg-[#526A5A]! text-white!':tab==='document'}" @click="tab='document'">Document</button><button type="button" :class="{'bg-[#526A5A]! text-white!':tab==='seo'}" @click="tab='seo'">SEO & Social</button><button type="button" :class="{'bg-[#526A5A]! text-white!':tab==='advanced'}" @click="tab='advanced'">Advanced</button></div><div x-show="tab==='document'" class="grid gap-3 [&_label]:grid [&_label]:gap-1.5 [&_label]:text-[13px] [&_label]:font-semibold [&_label]:uppercase [&_label]:tracking-wide [&_input]:rounded-md [&_input]:border [&_input]:border-[#DDE2DF] [&_input]:bg-white [&_input]:p-2.5 [&_input]:text-sm [&_textarea]:rounded-md [&_textarea]:border [&_textarea]:border-[#DDE2DF] [&_textarea]:bg-white [&_textarea]:p-2.5 [&_textarea]:text-sm [&_select]:rounded-md [&_select]:border [&_select]:border-[#DDE2DF] [&_select]:bg-white [&_select]:p-2.5 [&_select]:text-sm"><label>Publishing State<select x-model="status"><option value="draft">Working Draft</option><option value="scheduled">Scheduled</option><option value="published">Published</option><option value="archived">Archived</option></select></label><label>Primary Section<select name="category_id"><option value="">Uncategorized</option><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($category->id); ?>" <?php if((string)old('category_id',$isEdit?$post->category_id:'')===(string)$category->id): echo 'selected'; endif; ?>><?php echo e($category->name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select></label><div><span class="text-[13px] font-semibold uppercase tracking-wide text-[#526A5A]">Descriptive Tags</span><div class="flex flex-wrap gap-2"><?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><label><input type="checkbox" name="tags[]" value="<?php echo e($tag->id); ?>" <?php if(in_array($tag->id, old('tags',$isEdit?$post->tags->pluck('id')->all():[]))): echo 'checked'; endif; ?>><span>#<?php echo e($tag->name); ?></span></label><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></div></div><label>Featured Visual Asset<select name="featured_media_id"><option value="">None</option><?php $__currentLoopData = $media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($asset->id); ?>" <?php if((string)old('featured_media_id',$isEdit?$post->featured_media_id:'')===(string)$asset->id): echo 'selected'; endif; ?>><?php echo e($asset->original_name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select></label><label class="flex items-center gap-2 text-sm"><input type="checkbox" name="is_featured" value="1" <?php if(old('is_featured',$isEdit?$post->is_featured:false)): echo 'checked'; endif; ?>> Feature this article</label></div><div x-show="tab==='seo'" class="grid gap-3 [&_label]:grid [&_label]:gap-1.5 [&_label]:text-[13px] [&_label]:font-semibold [&_label]:uppercase [&_label]:tracking-wide [&_input]:rounded-md [&_input]:border [&_input]:border-[#DDE2DF] [&_input]:bg-white [&_input]:p-2.5 [&_input]:text-sm [&_textarea]:rounded-md [&_textarea]:border [&_textarea]:border-[#DDE2DF] [&_textarea]:bg-white [&_textarea]:p-2.5 [&_textarea]:text-sm [&_select]:rounded-md [&_select]:border [&_select]:border-[#DDE2DF] [&_select]:bg-white [&_select]:p-2.5 [&_select]:text-sm"><label>SEO Title<input name="seo_title" value="<?php echo e(old('seo_title',$isEdit?$post->seo_title:'')); ?>"></label><label>Meta Description<textarea name="seo_description"><?php echo e(old('seo_description',$isEdit?$post->seo_description:'')); ?></textarea></label><div class="rounded-lg border border-[#EBEFEA] bg-[#FAFCFA] p-3 text-sm [&_strong]:block [&_strong]:text-[#293C32] [&_span]:mt-1 [&_span]:block [&_span]:text-[#545F57]"><small>Search & Metadata Snippet</small><strong><?php echo e(old('title',$isEdit?$post->title:'Untitled article')); ?></strong><p><?php echo e(old('excerpt',$isEdit?$post->excerpt:'Write a useful summary for readers and search engines.')); ?></p></div></div><div x-show="tab==='advanced'" class="grid gap-3 [&_label]:grid [&_label]:gap-1.5 [&_label]:text-[13px] [&_label]:font-semibold [&_label]:uppercase [&_label]:tracking-wide [&_input]:rounded-md [&_input]:border [&_input]:border-[#DDE2DF] [&_input]:bg-white [&_input]:p-2.5 [&_input]:text-sm [&_textarea]:rounded-md [&_textarea]:border [&_textarea]:border-[#DDE2DF] [&_textarea]:bg-white [&_textarea]:p-2.5 [&_textarea]:text-sm [&_select]:rounded-md [&_select]:border [&_select]:border-[#DDE2DF] [&_select]:bg-white [&_select]:p-2.5 [&_select]:text-sm"><label>Visibility<select name="visibility"><option value="public" <?php if(old('visibility', $isEdit ? $post->visibility : 'public') === 'public'): echo 'selected'; endif; ?>>Public</option><option value="private" <?php if(old('visibility', $isEdit ? $post->visibility : 'public') === 'private'): echo 'selected'; endif; ?>>Private</option></select></label><label>Custom Slug<input name="slug" value="<?php echo e(old('slug',$isEdit?$post->slug:'')); ?>" placeholder="auto-generated-from-title"></label><label>Canonical URL<input name="canonical_url" value="<?php echo e(old('canonical_url',$isEdit?$post->canonical_url:'')); ?>"></label><label>Publish Date<input type="datetime-local" name="published_at" value="<?php echo e(old('published_at',$isEdit&&$post->published_at?$post->published_at->format('Y-m-d\\TH:i'):'')); ?>"></label><label>Schedule Date<input type="datetime-local" name="scheduled_at" value="<?php echo e(old('scheduled_at',$isEdit&&$post->scheduled_at?$post->scheduled_at->format('Y-m-d\\TH:i'):'')); ?>"></label><label class="flex items-center gap-2 text-sm"><input type="hidden" name="allow_indexing" value="0"><input type="checkbox" name="allow_indexing" value="1" <?php if(old('allow_indexing',$isEdit?$post->allow_indexing:true)): echo 'checked'; endif; ?>> Allow search engine indexing</label></div><?php if($isEdit): ?><div class="mt-4 border-t border-[#EBEFEA] pt-4 text-[13px] leading-relaxed text-[#545F57]"><span>Last updated <?php echo e($post->updated_at?->diffForHumans()); ?> · Reading time recalculates automatically when saved.</span></div><?php endif; ?></aside></div>

<div x-show="previewMode" x-transition.opacity x-cloak class="fixed inset-0 z-[80] overflow-y-auto bg-[#1C2821]/55 p-4 backdrop-blur-sm" @keydown.escape.window="previewMode=false">
  <div class="mx-auto my-6 max-w-4xl overflow-hidden rounded-2xl bg-[#FBF9F3] shadow-2xl" @click.outside="previewMode=false">
    <div class="sticky top-0 z-10 flex items-center justify-between border-b border-[#E4E5DE] bg-[#FBF9F3]/95 px-5 py-3 backdrop-blur">
      <div><p class="m-0 text-[13px] font-semibold uppercase tracking-[.1em] text-[#526A5A]">Draft preview</p><p class="m-0 mt-0.5 text-sm text-[#545F57]">This is a CMS preview. Save before opening the public website.</p></div>
      <button type="button" class="grid size-9 place-items-center rounded-full border border-[#DDE2DF] bg-white text-lg" @click="previewMode=false" aria-label="Close"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'close']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'close']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?></button>
    </div>
    <article class="mx-auto max-w-3xl px-6 py-10 sm:px-10 sm:py-14">
      <p class="text-[14px] font-semibold uppercase tracking-[.12em] text-[#526A5A]"><?php echo e(strtoupper(str_replace('_',' ',$currentType))); ?></p>
      <h1 class="mt-3 font-['Newsreader'] text-4xl font-medium leading-tight text-[#293C32] sm:text-5xl" x-text="$root.querySelector('[name=title]').value || 'Untitled article'"></h1>
      <p class="mt-4 text-base leading-7 text-[#545F57]" x-text="$root.querySelector('[name=excerpt]').value"></p>
      <div class="mt-10 space-y-6">
        <template x-for="block in blocks" :key="'preview-'+block.uid">
          <div>
            <template x-if="block.type==='heading'"><h2 class="font-['Newsreader'] text-3xl font-medium text-[#293C32]" x-text="block.data.text"></h2></template>
            <template x-if="block.type==='paragraph'"><p class="whitespace-pre-line font-['Newsreader'] text-lg leading-8 text-[#323934]" x-text="block.data.text"></p></template>
            <template x-if="block.type==='quote'"><blockquote class="border-l-4 border-[#8FA58F] pl-5 font-['Newsreader'] text-2xl italic leading-9 text-[#526A5A]" x-text="block.data.text"></blockquote></template>
            <template x-if="block.type==='callout'"><div class="rounded-xl bg-[#E7ECE5] p-5"><strong class="text-sm text-[#293C32]" x-text="block.data.title"></strong><p class="mt-2 whitespace-pre-line text-sm leading-6 text-[#526A5A]" x-text="block.data.text"></p></div></template>
            <template x-if="block.type==='checklist'"><div class="space-y-2"><template x-for="line in String(block.data.text || '').split('\n').filter(Boolean)"><div class="flex gap-2 text-sm"><span class="text-[#526A5A]">✓</span><span x-text="line"></span></div></template></div></template>
            <template x-if="block.type==='image'"><figure><img x-show="block.data.url" :src="block.data.url" :alt="block.data.alt || block.data.caption || ''" class="max-h-[560px] w-full rounded-xl object-cover"><figcaption class="mt-2 text-center text-sm text-[#545F57]" x-text="block.data.caption"></figcaption></figure></template>
          </div>
        </template>
      </div>
    </article>
  </div>
</div>
</form>
<?php $__env->startPush('scripts'); ?><script>window.__postEditorInitial=<?php echo json_encode($blocks, 15, 512) ?>;</script><?php $__env->stopPush(); ?><?php /**PATH /Users/ferdy/project-fl/vet-cms/backend/resources/views/admin/posts/_editor.blade.php ENDPATH**/ ?>