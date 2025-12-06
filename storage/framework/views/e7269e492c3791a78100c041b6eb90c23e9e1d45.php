<?php $__env->startSection('body'); ?>
    <?php echo $__env->yieldContent('content'); ?>
    
    <?php if(isset($slot)): ?>
        <?php echo e($slot); ?>

    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\ImamMuzani\resources\views/layouts/app.blade.php ENDPATH**/ ?>