
<?php $__env->startSection('subtitle', 'nuevo league'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-10 col-lg-6 mx-auto">
                <form method="POST" action="<?php echo e(route('leagues.store')); ?>" class="bg-white shadow rounded py-3 px-4">
                    <h2><?php echo app('translator')->get('New league'); ?></h2>
                    <hr>
                    <?php echo $__env->make('partials.validation-errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo $__env->make('leagues._form', ['btnText' => __('Create new league')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\bolatoki\resources\views/leagues/create.blade.php ENDPATH**/ ?>