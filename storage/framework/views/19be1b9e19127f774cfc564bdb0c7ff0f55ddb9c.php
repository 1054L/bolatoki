
<?php $__env->startSection('subtitle', $court->name); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="bg-white p-5 shadow rounded">
            <h2><?php echo e($court->name); ?></h2>
            <p class="text-secondary">
                <i class="fas fa-map-pin"></i> <span> <?php echo e($court->address); ?></span><br>
                <div class="d-flex justify-content-between align-items-center">
                    <a class="btn btn-primary" href="<?php echo e(route('courts.index')); ?>"><?php echo app('translator')->get('Retourn'); ?></a>
                    <?php if(auth()->guard()->check()): ?>
                    <div class="btn-group btn-group-sm">
                        <a class="btn btn-primary" href="<?php echo e(route('courts.edit', $court)); ?>"><?php echo app('translator')->get('Edit'); ?></a>
                        <a class="btn btn-danger" href="#" onclick="document.getElementById('delete-court').submit()"><?php echo app('translator')->get('Delete'); ?></a>
                    </div>
                    <?php endif; ?>
                </div>
                    <form id="delete-court" method="POST" action="<?php echo e(route('courts.destroy', $court)); ?>" style="display: none">
                        <?php echo csrf_field(); ?> <?php echo method_field("DELETE"); ?> <button><?php echo app('translator')->get('Delete'); ?></button>
                    </form>
            </p>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\bolatoki\resources\views/courts/show.blade.php ENDPATH**/ ?>