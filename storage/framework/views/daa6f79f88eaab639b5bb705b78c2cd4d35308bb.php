
<?php $__env->startSection('subtitle', $player->name . ' ' . $player->surname ); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="bg-white p-5 shadow rounded">
            <h2><?php echo e($player->name); ?> <?php echo e($player->surname); ?></h2>
            <p class="text-secondary">
                <?php if(isset($player->birth_date)): ?>
                <i class="fas fa-birthday-cake"></i> <small><?php echo e($player->birth_date); ?></small><br>
                <?php endif; ?>
                <i class="fas fa-igloo"></i>         <span><?php echo e($player->club); ?></span><br>
                <i class="fas fa-at"></i>            <span><?php echo e($player->email); ?></span><br>
                <i class="fas fa-phone"></i>         <span><?php echo e($player->phone); ?></span><br>
                <div class="d-flex justify-content-between align-items-center">
                    <a class="btn btn-primary" href="<?php echo e(route('players.index')); ?>"><?php echo app('translator')->get('Retourn'); ?></a>
                    <?php if(auth()->guard()->check()): ?>
                    <div class="btn-group btn-group-sm">
                        <a class="btn btn-primary" href="<?php echo e(route('players.edit', $player)); ?>"><?php echo app('translator')->get('Edit'); ?></a>
                        <a class="btn btn-danger" href="#" onclick="document.getElementById('delete-player').submit()"><?php echo app('translator')->get('Delete'); ?></a>
                    </div>
                    <?php endif; ?>
                </div>
                    <form id="delete-player" method="POST" action="<?php echo e(route('players.destroy', $player)); ?>" style="display: none">
                        <?php echo csrf_field(); ?> <?php echo method_field("DELETE"); ?> <button><?php echo app('translator')->get('Delete'); ?></button>
                    </form>
            </p>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\bolatoki\resources\views/players/show.blade.php ENDPATH**/ ?>