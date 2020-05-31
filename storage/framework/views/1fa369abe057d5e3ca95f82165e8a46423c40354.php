<div class="form-group">
    <label for="<?php echo e($name); ?>"><?php echo e($Name); ?></label>
    <input type="text" name="<?php echo e($name); ?>" id="<?php echo e($name); ?>" value="<?php echo e(old($name, $court->$name)); ?>" class="form-control bg-light shadow-sm <?php $__errorArgs = ['<?php echo e($name); ?>'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"> 
    <?php $__errorArgs = ['<?php echo e($name); ?>'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> 
        <span class="invalid-feedback" role="alert">
            <strong><?php echo e($message); ?></strong>
        </span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div><?php /**PATH C:\laragon\www\bolatoki\resources\views/courts/_input.blade.php ENDPATH**/ ?>