<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Content Studio'); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Newsreader:opsz,wght@6..72,400;6..72,500;6..72,600&display=swap"
        rel="stylesheet">
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    
    <?php echo $__env->yieldPushContent('head'); ?>
</head>

<body class="[text-rendering:optimizeLegibility] [&_[x-cloak]]:hidden! m-0 min-h-screen bg-[#F7F5EF] font-[Inter,sans-serif] text-[14px] leading-relaxed text-[#252A27] [overflow-wrap:anywhere] [:where(&)_*]:min-w-0 [:where(&)_h1]:font-[Newsreader,serif] [:where(&)_h1]:text-[clamp(28px,3vw,40px)] [:where(&)_h1]:leading-tight [:where(&)_h1]:font-medium [:where(&)_h1]:my-3 [:where(&)_h2]:text-xl [:where(&)_h2]:font-semibold [:where(&)_h3]:text-lg [:where(&)_h3]:font-semibold [:where(&)_p]:leading-relaxed [:where(&)_small]:text-xs [:where(&)_input]:text-base! [:where(&)_textarea]:text-base! [:where(&)_select]:text-base! [:where(&)_button]:min-h-10 [:where(&)_a:focus-visible]:outline-2 [:where(&)_a:focus-visible]:outline-offset-2 [:where(&)_button:focus-visible]:outline-2 [:where(&)_button:focus-visible]:outline-offset-2 [:where(&)_input:focus-visible]:outline-2 [:where(&)_textarea:focus-visible]:outline-2 [:where(&)_select:focus-visible]:outline-2 [:where(&)_:focus-visible]:outline-[#526A5A] antialiased">
    <div class="flex min-h-screen" x-data="cmsShell()" @keydown.escape.window="closeMobileNav()">
        <div x-show="mobileNav" x-transition.opacity x-cloak @click="mobileNav=false" class="fixed inset-0 z-40 bg-[#1C2821]/35 backdrop-blur-[1px] lg:hidden"></div>
        <?php echo $__env->make('admin.partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <div class="flex-1 min-w-0 lg:ml-60">
            <?php echo $__env->make('admin.partials.topbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <main class="mx-auto w-full max-w-[1760px] px-4 pb-16 pt-6 sm:px-7 lg:px-8 <?php echo $__env->yieldContent('content-class'); ?>">
                <?php if(session('success')): ?>
                    <div class="mb-[18px] rounded-md px-3.5 py-3 text-[15px] bg-[#E7F1E8] text-[#2E5A3B]">
                        <?php echo e(session('success')); ?></div>
                <?php endif; ?>
                <?php if(session('error')): ?>
                    <div class="mb-[18px] rounded-md px-3.5 py-3 text-[15px] bg-[#FFF0EE] text-[#8A2F27]">
                        <?php echo e(session('error')); ?></div>
                <?php endif; ?>
                <?php if($errors->any()): ?>
                    <div class="mb-[18px] rounded-md px-3.5 py-3 text-[15px] bg-[#FFF0EE] text-[#8A2F27]"><strong>Please
                            review the form.</strong>
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <?php echo $__env->yieldContent('content'); ?>
            </main>
        </div>
    </div>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>

</html>
<?php /**PATH /Users/ferdy/project-fl/vet-cms/backend/resources/views/admin/layouts/app.blade.php ENDPATH**/ ?>