<?php echo csrf_field(); ?>
<?php echo $__env->make('courts._input', ['name' => 'name', 'Name' => 'Name'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('courts._input', ['name' => 'address', 'Name' => 'Address'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('courts._input', ['name' => 'responsable', 'Name' => 'Responsable'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<button class="btn btn-primary btn-lg btn-block"><?php echo e($btnText); ?></button><?php /**PATH C:\laragon\www\bolatoki\resources\views/courts/_form.blade.php ENDPATH**/ ?>