<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($title ?? 'Dashboard Ustadz'); ?></title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('mazer/dist/assets/css/bootstrap.css')); ?>?v=<?php echo e(time()); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('mazer/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.css')); ?>?v=<?php echo e(time()); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('mazer/dist/assets/vendors/bootstrap-icons/bootstrap-icons.css')); ?>?v=<?php echo e(time()); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('mazer/dist/assets/css/app.css')); ?>?v=<?php echo e(time()); ?>">
    <link rel="shortcut icon" href="<?php echo e(asset('mazer/dist/assets/images/favicon.svg')); ?>" type="image/x-icon">

    <?php echo \Livewire\Livewire::styles(); ?>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div id="app">

        
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="<?php echo e(route('dashboardustadz')); ?>">
                                <img src="<?php echo e(asset('/images/logoremove.png')); ?>" alt="Logo" style="height: 60px; width:auto;">
                            </a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block">
                                <i class="bi bi-x bi-middle"></i>
                            </a>
                        </div>
                    </div>
                </div>

                
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Dashboard</li>

                        <li class="sidebar-item <?php echo e(request()->routeIs('dashboardustadz') ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('dashboardustadz')); ?>" class="sidebar-link">
                                <i class="bi bi-grid-fill"></i>
                                <span>Beranda</span>
                            </a>
                        </li>

                        <li class="sidebar-title">Menu Ustadz</li>

                        <li class="sidebar-item <?php echo e(request()->routeIs('ustadz.jadwal*') ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('ustadz.jadwal')); ?>" class="sidebar-link">
                                <i class="bi bi-calendar-event-fill"></i>
                                <span>Jadwal Mengajar</span>
                            </a>
                        </li>

                        <li class="sidebar-item <?php echo e(request()->routeIs('ustadz.santri*') ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('ustadz.santri')); ?>" class="sidebar-link">
                                <i class="bi bi-people-fill"></i>
                                <span>Data Santri</span>
                            </a>
                        </li>

                        <li class="sidebar-item <?php echo e(request()->routeIs('ustadz.hafalan*') ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('ustadz.hafalan')); ?>" class="sidebar-link">
                                <i class="bi bi-book-half"></i>
                                <span>Input Hafalan</span>
                            </a>
                        </li>

                        <li class="sidebar-item <?php echo e(request()->routeIs('ustadz.laporan*') ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('ustadz.laporan')); ?>" class="sidebar-link">
                                <i class="bi bi-file-earmark-text-fill"></i>
                                <span>Laporan</span>
                            </a>
                        </li>
                        <li class="sidebar-item mt-3">
                            <a href="#" class="sidebar-link text-danger" onclick="confirmLogout(event)">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Logout</span>
                            </a>
                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                <?php echo csrf_field(); ?>
                            </form>
                        </li>
                    </ul>
                </div>

                <script>
                    function confirmLogout(e) {
                        e.preventDefault();
                        Swal.fire({
                            title: 'Yakin ingin keluar?',
                            text: "Anda akan diarahkan kembali ke halaman login.",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Ya, Keluar!',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                document.getElementById('logout-form').submit();
                            }
                        })
                    }
                </script>

                <button class="sidebar-toggler btn x">
                    <i data-feather="x"></i>
                </button>
            </div>
        </div>

        
        <div id="main">

            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            
            <div class="page-heading">
                <h3><?php echo e($title ?? 'Dashboard Ustadz'); ?></h3>
            </div>

            
            <div class="page-content">
                <?php echo e($slot); ?>

            </div>

            
            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>© <?php echo e(date('Y')); ?> Sistem Informasi Santri</p>
                    </div>
                    <div class="float-end">
                        <p>Developed by <span class="text-primary">Ashyan</span></p>
                    </div>
                </div>
            </footer>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="<?php echo e(asset('mazer/dist/vendors/perfect-scrollbar/perfect-scrollbar.min.js')); ?>"></script>
    <script src="<?php echo e(asset('mazer/dist/assets/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('mazer/dist/assets/js/main.js')); ?>"></script>

    <?php echo \Livewire\Livewire::scripts(); ?>

    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\xampp\ImamMuzani\resources\views/layouts/dashboardustadz.blade.php ENDPATH**/ ?>