
<?php $__env->startSection('subtitle', $league->name); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="bg-white p-5 shadow rounded">
            <h2><?php echo e($league->name); ?></h2>
            <p class="text-secondary">
                <?php if(isset($league->start_date)): ?>
                <i class="fas fa-birthday-cake"></i> <small><?php echo e($league->start_date); ?> - <?php echo e($league->finish_date); ?></small><br>
                <?php endif; ?>
                
                <div class="d-flex justify-content-between align-items-center">
                    <a class="btn btn-primary" href="<?php echo e(route('leagues.index')); ?>"><?php echo app('translator')->get('Retourn'); ?></a>
                    <?php if(auth()->guard()->check()): ?>
                    <div class="btn-group btn-group-sm">
                        <a class="btn btn-primary" href="<?php echo e(route('leagues.edit', $league)); ?>"><?php echo app('translator')->get('Edit'); ?></a>
                        <a class="btn btn-danger" href="#" onclick="document.getElementById('delete-league').submit()"><?php echo app('translator')->get('Delete'); ?></a>
                    </div>
                    <?php endif; ?>
                </div>
                    <form id="delete-league" method="POST" action="<?php echo e(route('leagues.destroy', $league)); ?>" style="display: none">
                        <?php echo csrf_field(); ?> <?php echo method_field("DELETE"); ?> <button><?php echo app('translator')->get('Delete'); ?></button>
                    </form>
            </p>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\bolatoki\resources\views/leagues/show.blade.php ENDPATH**/ ?>