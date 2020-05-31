<nav class="navbar bg-white shadow-sm">
    <div class="container">
        <a href="<?php echo e(route('home')); ?>" class="logo"><?php echo e(config('app.name')); ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="<?php echo e(__('Toggle navigation')); ?>">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="navbarSupportedContent">
            <ul class="nav navbar-expand-sm navbar-light nav-pills">
                <li class="nav-item">
                    <a href="<?php echo e(route('leagues.index')); ?>" class="nav-link <?php echo e(setActive('leagues.*')); ?>">
                        <?php echo app('translator')->get('Leagues'); ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('players.index')); ?>" class="nav-link <?php echo e(setActive('players.*')); ?>">
                        <?php echo app('translator')->get('Players'); ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('courts.index')); ?>" class="nav-link <?php echo e(setActive('courts.*')); ?>">
                        <?php echo app('translator')->get('Courts'); ?>
                    </a>
                </li>
                <ul class="nav navbar-expand-sm navbar-light nav-pills float-right">
                    <?php if(auth()->guard()->guest()): ?>
                        <li class="nav-item"><a href="<?php echo e(route('login')); ?>" class="nav-link login <?php echo e(setActive('login')); ?>"><?php echo app('translator')->get('Login'); ?></a></li>
                        <li class="nav-item"><a href="<?php echo e(route('register')); ?>" class="nav-link login <?php echo e(setActive('register')); ?>"><?php echo app('translator')->get('Register'); ?></a></li>
                    <?php endif; ?>
                    <?php if(auth()->guard()->check()): ?>
                        <li class="nav-item"><a href="#" class="nav-link" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();"><?php echo app('translator')->get('Logout'); ?></a></li>
                        <form id="logout-form" method="POST" action="<?php echo e(route('logout')); ?>" class="d-none">
                            <?php echo csrf_field(); ?>
                        </form>
                    <?php endif; ?>
                </ul>
            </ul>
        </div>
    </div>
</nav><?php /**PATH C:\laragon\www\bolatoki\resources\views/partials/navbar.blade.php ENDPATH**/ ?>