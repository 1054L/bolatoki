<div class="modal">
    <div class="title"><?php echo e($title); ?></div>
    <div class="body">
        <?php echo e($body); ?>

        <?php if(isset($variable)): ?>
            <br>
            <?php echo e($variable); ?>

        <?php endif; ?>
    </div>
    <div class="footer">
        <button class="btn btn-danger">Cancelar</button>
        <button class="btn btn-success">Aceptar</button>
</div><?php /**PATH C:\laragon\www\bolatoki\resources\views/components/alert.blade.php ENDPATH**/ ?>