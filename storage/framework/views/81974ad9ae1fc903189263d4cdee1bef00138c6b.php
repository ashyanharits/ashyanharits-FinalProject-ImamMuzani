
<?php $__env->startSection('page-title', 'Dashboard Admin'); ?>

<?php $__env->startSection('content'); ?>
    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('card-dashboard')->html();
} elseif ($_instance->childHasBeenRendered('gfYqb90')) {
    $componentId = $_instance->getRenderedChildComponentId('gfYqb90');
    $componentTag = $_instance->getRenderedChildComponentTagName('gfYqb90');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('gfYqb90');
} else {
    $response = \Livewire\Livewire::mount('card-dashboard');
    $html = $response->html();
    $_instance->logRenderedChild('gfYqb90', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\ImamMuzani\resources\views/admin/index.blade.php ENDPATH**/ ?>