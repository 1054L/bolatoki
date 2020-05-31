<?php $__env->startSection('subtitle'); ?>
<?php echo app('translator')->get('leagues'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-10 col-lg-6">
                <div class="d-flex justify-content-between align-items-cneter">
                    <h2 class="display-4 mb-0"><?php echo app('translator')->get('Leagues'); ?></h2>
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('leagues.create')); ?>" class="btn btn-primary my-auto"> <?php echo app('translator')->get('Create a new league'); ?></a>
                    <?php endif; ?>
                </div>
                <hr>
                <ul class="list-group">
                    <?php $__empty_1 = true; $__currentLoopData = $leagues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $league): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <li class="list-group-item border-0 mb-3 shadow-sm">
                            <a href="<?php echo e(route('leagues.show', $league)); ?>" class="text-secondary d-flex justify-content-between align-items-center">
                                <span class="font-weight-bold"><?php echo e($league->name); ?></span> <span><?php echo e($league->start_date); ?> - <?php echo e($league->finish_date); ?></span>
                            </a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <li><?php echo app('translator')->get('There are no entries for this table'); ?></li>
                    <?php endif; ?>
                </ul>
                <?php echo e($leagues->links()); ?>

            </div>
            <div class="col-12 col-lg-6">
                <img class="img-fluid" src="/img/liga.svg" alt="bolatoki">
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\bolatoki\resources\views/leagues/index.blade.php ENDPATH**/ ?>