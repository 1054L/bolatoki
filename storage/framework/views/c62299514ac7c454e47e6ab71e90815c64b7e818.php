<?php echo csrf_field(); ?>
<?php echo $__env->make('players._input', ['name' => 'name', 'Name' => 'Name'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('players._input', ['name' => 'surname', 'Name' => 'Surname'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('players._input', ['name' => 'club', 'Name' => 'Club'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('players._input', ['name' => 'email', 'Name' => 'Email'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('players._input', ['name' => 'phone', 'Name' => 'Tel'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<button class="btn btn-primary btn-lg btn-block"><?php echo e($btnText); ?></button><?php /**PATH C:\laragon\www\bolatoki\resources\views/players/_form.blade.php ENDPATH**/ ?>