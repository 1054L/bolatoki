<?php $__env->startSection('subtitle'); ?>
<?php echo app('translator')->get('players'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <h2><?php echo app('translator')->get('Players'); ?></h2>
    <table class="classificationTable">
        <tr><th><?php echo app('translator')->get('Name'); ?></th><th><?php echo app('translator')->get('Birth date'); ?></th><th><?php echo app('translator')->get('Club'); ?></th><th><?php echo app('translator')->get('Email'); ?></th><th><?php echo app('translator')->get('Telephone'); ?></th><th><?php echo app('translator')->get('Actions'); ?></th></tr>
        <?php $__empty_1 = true; $__currentLoopData = $players; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $player): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><a href="<?php echo e(route('players.show', $player)); ?>" class="actionsLink"><?php echo e($player->name); ?> <?php echo e($player->surname); ?></a></td>
                <td><?php echo e($player->birthDate); ?></td>
                <td><?php echo e($player->club); ?></td>
                <td><?php echo e($player->email); ?></td>
                <td><?php echo e($player->tel); ?></td>
                <td>
                    <a href="/bolariak/<?php echo e($player->name); ?>" class="actionLink"><i class="far fa-eye"></i></a>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="6"><?php echo app('translator')->get('There are no entries for this table'); ?></td></tr>
        <?php endif; ?>
    </table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\bolatoki\resources\views/sections/bolariak.blade.php ENDPATH**/ ?>