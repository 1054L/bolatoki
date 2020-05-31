<?php echo csrf_field(); ?>
<?php echo $__env->make('leagues._input', ['name' => 'name', 'Name' => 'Name'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('leagues._input', ['name' => 'start_date', 'Name' => 'Start date'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('leagues._input', ['name' => 'finish_date', 'Name' => 'Finish date'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<button class="btn btn-primary btn-lg btn-block"><?php echo e($btnText); ?></button><?php /**PATH C:\laragon\www\bolatoki\resources\views/leagues/_form.blade.php ENDPATH**/ ?>