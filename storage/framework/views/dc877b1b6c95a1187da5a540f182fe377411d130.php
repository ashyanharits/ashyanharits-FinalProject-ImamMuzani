<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <?php if (! empty(trim($__env->yieldContent('title')))): ?>
            <title><?php echo $__env->yieldContent('title'); ?> - <?php echo e(config('app.name')); ?></title>
        <?php else: ?>
            <title><?php echo e(config('app.name')); ?></title>
        <?php endif; ?>

        <!-- ✅ Favicon -->
        <link rel="shortcut icon" href="<?php echo e(asset('favicon.ico')); ?>" type="image/x-icon">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

        <!-- ✅ Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

        <?php echo app('Illuminate\Foundation\Vite')(['resources/sass/app.scss', 'resources/js/app.js']); ?>
        <?php echo \Livewire\Livewire::styles(); ?>

        <?php echo \Livewire\Livewire::scripts(); ?>


        <!-- ✅ Smooth scroll -->
        <style>
            html {
                scroll-behavior: smooth !important;
            }
        </style>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    </head>

    <body>
        <?php echo $__env->yieldContent('body'); ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Tombol Back to Top -->
<button id="backToTopBtn" 
    class="hidden fixed bottom-6 right-6 bg-[#C57A00] text-white px-4 py-2 rounded-full shadow-lg hover:bg-[#a96b00] transition-all duration-300">
    ↑
</button>

<script>
    const backToTopBtn = document.getElementById('backToTopBtn');

    // Muncul pas scroll lebih dari 200px
    window.addEventListener('scroll', () => {
        if (window.scrollY > 200) {
            backToTopBtn.classList.remove('hidden');
        } else {
            backToTopBtn.classList.add('hidden');
        }
    });

    // Scroll halus ke atas
    backToTopBtn.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
</script>

    </body>
</html>
<?php /**PATH C:\xampp\ImamMuzani\resources\views/layouts/base.blade.php ENDPATH**/ ?>