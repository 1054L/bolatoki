<?php $__env->startSection('subtitle'); ?>
<?php echo app('translator')->get('classification'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <h2><?php echo app('translator')->get('Actual league classification'); ?></h2>
    <table class="classificationTable">
        
        
    </table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\bolatoki\resources\views/sections/classification.blade.php ENDPATH**/ ?>