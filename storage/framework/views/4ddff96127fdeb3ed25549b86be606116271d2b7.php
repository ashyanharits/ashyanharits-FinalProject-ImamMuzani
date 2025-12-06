<?php $__env->startSection('body'); ?>
    <div class="flex flex-col justify-center min-h-screen py-12 bg-gray-50 sm:px-6 lg:px-8">
        <?php echo $__env->yieldContent('content'); ?>

        <?php if(isset($slot)): ?>
            <?php echo e($slot); ?>

        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\ImamMuzani\resources\views/layouts/auth.blade.php ENDPATH**/ ?>