<?php $__env->startSection('title','Edit '.$post->title.' · Content Studio'); ?>
<?php $__env->startSection('breadcrumb','Journal / Edit'); ?>
<?php $__env->startSection('content-class','!p-0 bg-[#F7F5EF]'); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('admin.posts._editor',['post'=>$post], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/ferdy/project-fl/vet-cms/backend/resources/views/admin/posts/edit.blade.php ENDPATH**/ ?>