<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <?php echo $__env->make('head.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <title>Bolatoki | <?php echo $__env->yieldContent('subtitle'); ?></title>
    </head>
    <body>
        <div id="app" class="d-felx flex-column h-screen justify-content-between bg-light">
            <header>
                <?php echo $__env->make('partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo $__env->make('partials.session-status', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </header>
            <div class="navbarmargin"></div>
            <main class="py-4">
                <?php echo $__env->yieldContent('content'); ?>
            </main>
            <footer class="bg-white text-center text-black-50 py-3 shadow">
                <?php echo e(config('app.name')); ?> | Copyright <?php echo e(date('Y')); ?>

            </footer>
        </div>
    </body>
</html><?php /**PATH C:\laragon\www\bolatoki\resources\views/master.blade.php ENDPATH**/ ?>