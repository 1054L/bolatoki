
<?php $__env->startSection('subtitle'); ?>
<?php echo app('translator')->get('league'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <h2><?php echo e($leagueName); ?></h2>
    <table class="classificationTable">
        <tr><th><?php echo app('translator')->get('Date'); ?></th><th><?php echo app('translator')->get('Court'); ?></th><th><?php echo app('translator')->get('Winner'); ?></th><th><?php echo app('translator')->get('Actions'); ?></th></tr>
        <?php $__currentLoopData = $matches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $match): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($match['date']); ?></td>
                <td><?php echo e($match['court']); ?></a></td>
                <td><?php echo e($match['winner']); ?></a></td>
                <td>
                    <a herf="/bolatokiak/<?php echo e($match['court']); ?>" class="actionLink"><i class="fas fa-map-marker-alt"></i></a>
                    <a href="/bolariak/<?php echo e($match['winner']); ?>" class="actionLink"><i class="far fa-eye"></i></a>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\bolatoki\resources\views/sections/league.blade.php ENDPATH**/ ?>