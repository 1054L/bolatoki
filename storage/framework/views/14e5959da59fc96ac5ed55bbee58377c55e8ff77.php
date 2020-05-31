<?php $__env->startSection('title', 'Bolatoki users'); ?>
<?php $__env->startSection('sidebar'); ?>
    @parent
    <p>Página de usuarios de Bolatoki</p>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <p>Contenido de users de Bolatoki</p>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <span class="nombre"><?php echo e($name); ?></span>
            <div class="title m-b-md">
                <?php echo e($surname); ?>

            </div>
            <div><i class="fas fa-igloo"></i>&nbsp;<?php echo e($address); ?></div>
            <div><i class="fas fa-mobile-alt"></i>&nbsp;<?php echo e($tel); ?></div>
            <?php if(isset($mail)): ?>
                <div><i class="far fa-envelope"></i><?php echo e($mail); ?></div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>
    @alert
        <?php $__env->slot('title'); ?>
            Alerta!
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('body'); ?>
            Cuerpo de la alerta, aunque por ahora no diga nada de nada.
        <?php $__env->endSlot(); ?>
    @endalert
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\bolatoki\resources\views/users.blade.php ENDPATH**/ ?>