<div class="container-fluid p-4">

    <style>
        .dashboard-header {
            background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%);
            color: white;
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 10px 20px rgba(13, 110, 253, 0.15);
        }
        
        .stat-card {
            background: white;
            border-radius: 12px;
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            transition: transform 0.2s;
            height: 100%;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }

        .icon-box {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .bg-soft-primary { background-color: rgba(13, 110, 253, 0.1); color: #0d6efd; }
        .bg-soft-success { background-color: rgba(25, 135, 84, 0.1); color: #198754; }
        .bg-soft-warning { background-color: rgba(255, 193, 7, 0.1); color: #ffc107; }
        .bg-soft-danger { background-color: rgba(220, 53, 69, 0.1); color: #dc3545; }

        .chart-bar {
            height: 150px;
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            padding-top: 20px;
        }
        
        .bar-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            margin: 0 5px;
        }
        
        .bar {
            width: 100%;
            background-color: #e9ecef;
            border-radius: 4px 4px 0 0;
            transition: height 0.5s ease;
            position: relative;
        }
        
        .bar:hover {
            background-color: #0d6efd;
        }
        
        .bar-label {
            font-size: 0.75rem;
            color: #6c757d;
            margin-top: 5px;
        }

        .quick-action-btn {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            background: white;
            border: 1px solid #e9ecef;
            border-radius: 12px;
            text-decoration: none;
            color: #495057;
            transition: all 0.2s;
        }

        .quick-action-btn:hover {
            background: #f8f9fa;
            border-color: #0d6efd;
            color: #0d6efd;
            transform: translateY(-2px);
        }

        .table-custom th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            color: #6c757d;
            border-bottom: 2px solid #f8f9fa;
        }
        
        .avatar-circle {
            width: 35px;
            height: 35px;
            background-color: #e9ecef;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #495057;
            font-size: 0.8rem;
        }
    </style>

    
    <div class="dashboard-header d-flex justify-content-between align-items-center">
        <div>
            <h2 class="fw-bold mb-1">Ahlan wa Sahlan, Ustadz <?php echo e(Auth::user()->name); ?></h2>
            <p class="mb-0 opacity-75"><?php echo e($motivasi); ?></p>
        </div>
        <div class="d-none d-md-block text-end">
            <h4 class="mb-0"><?php echo e(now()->locale('id')->isoFormat('dddd, D MMMM Y')); ?></h4>
            <small class="opacity-75">Tahun Ajaran 2024/2025</small>
        </div>
    </div>

    
    <div class="row g-4 mb-4">
        
        <div class="col-md-3">
            <div class="stat-card p-4">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted mb-1 small fw-bold text-uppercase">Total Santri</p>
                        <h2 class="fw-bold mb-0"><?php echo e($totalSantri); ?></h2>
                        <small class="text-success"><i class="bi bi-arrow-up-short"></i> Santri Binaan</small>
                    </div>
                    <div class="icon-box bg-soft-primary">
                        <i class="bi bi-people-fill"></i>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-md-3">
            <div class="stat-card p-4">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted mb-1 small fw-bold text-uppercase">Keaktifan Minggu Ini</p>
                        <h2 class="fw-bold mb-0"><?php echo e($progressHafalan); ?>%</h2>
                        <div class="progress mt-2" style="height: 4px; width: 100px;">
                            <div class="progress-bar bg-success" style="width: <?php echo e($progressHafalan); ?>%"></div>
                        </div>
                    </div>
                    <div class="icon-box bg-soft-success">
                        <i class="bi bi-activity"></i>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-md-3">
            <div class="stat-card p-4">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted mb-1 small fw-bold text-uppercase">Setoran Hari Ini</p>
                        <?php
                            $todayCount = collect($chartData)->last()['count'] ?? 0;
                        ?>
                        <h2 class="fw-bold mb-0"><?php echo e($todayCount); ?></h2>
                        <small class="text-muted">Hafalan masuk</small>
                    </div>
                    <div class="icon-box bg-soft-warning">
                        <i class="bi bi-journal-check"></i>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-md-3">
            <div class="stat-card p-4">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted mb-1 small fw-bold text-uppercase">Belum Setor Hari Ini</p>
                        <h2 class="fw-bold mb-0"><?php echo e($santriButuhPerhatian->count()); ?></h2>
                        <small class="text-danger">Target hari ini</small>
                    </div>
                    <div class="icon-box bg-soft-danger">
                        <i class="bi bi-exclamation-triangle"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <div class="row g-4">
        
        <div class="col-lg-8">
            
            
            <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
                <div class="card-header bg-white border-0 py-4 px-4 d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fw-bold mb-0 text-dark">Statistik Setoran Hafalan</h6>
                        <small class="text-muted">7 Hari Terakhir</small>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-light btn-sm rounded-circle shadow-sm" type="button">
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body px-2">
                    <div id="hafalanChart"></div>
                </div>
            </div>

            
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-white border-0 py-4 px-4 d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fw-bold mb-0 text-dark">Setoran Hafalan Terbaru</h6>
                        <small class="text-muted">Update real-time aktivitas santri</small>
                    </div>
                    <a href="<?php echo e(route('ustadz.hafalan')); ?>" class="btn btn-sm btn-primary rounded-pill px-3">
                        Lihat Semua <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4 py-3 text-uppercase text-muted small fw-bold">Santri</th>
                                    <th class="py-3 text-uppercase text-muted small fw-bold">Hafalan</th>
                                    <th class="py-3 text-uppercase text-muted small fw-bold">Capaian</th>
                                    <th class="py-3 text-uppercase text-muted small fw-bold">Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $hafalanBaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-circle me-3 bg-primary text-white shadow-sm" style="width: 40px; height: 40px;">
                                                    <?php echo e(substr($h->santri->nama, 0, 1)); ?>

                                                </div>
                                                <div>
                                                    <div class="fw-bold text-dark"><?php echo e($h->santri->nama); ?></div>
                                                    <small class="text-muted"><?php echo e($h->santri->kelas ?? 'Kelas -'); ?></small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span class="fw-bold text-primary"><?php echo e($h->nama_hafalan); ?></span>
                                                <span class="badge bg-light text-secondary border rounded-pill mt-1" style="width: fit-content;">
                                                    Juz <?php echo e($h->juz ?? '-'); ?>

                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <?php if($h->total_halaman): ?>
                                                <span class="badge bg-opacity-10 text-success rounded-pill px-3 py-2">
                                                    <i class="bi bi-book me-1"></i> <?php echo e($h->total_halaman); ?> Halaman
                                                </span>
                                            <?php elseif($h->total_baris): ?>
                                                <span class="badge bg-opacity-10 text-info rounded-pill px-3 py-2">
                                                    <i class="bi bi-list-ul me-1"></i> <?php echo e($h->total_baris); ?> Baris
                                                </span>
                                            <?php else: ?>
                                                <span class="text-muted">-</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span class="text-muted small">
                                                <i class="bi bi-clock me-1"></i>
                                                <?php echo e($h->created_at->diffForHumans()); ?>

                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="4" class="text-center py-5">
                                            <img src="https://cdn-icons-png.flaticon.com/512/7486/7486754.png" alt="Empty" style="width: 64px; opacity: 0.5;" class="mb-3">
                                            <p class="text-muted mb-0">Belum ada data hafalan terbaru.</p>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    <script>
        document.addEventListener('livewire:load', function () {
            var options = {
                series: [{
                    name: 'Jumlah Setoran',
                    data: <?php echo json_encode(collect($chartData)->pluck('count'), 15, 512) ?>
                }],
                chart: {
                    type: 'bar',
                    height: 350,
                    fontFamily: 'inherit',
                    toolbar: { show: false },
                    animations: {
                        enabled: true,
                        easing: 'easeinout',
                        speed: 800,
                    }
                },
                plotOptions: {
                    bar: {
                        borderRadius: 8,
                        columnWidth: '50%',
                        distributed: true, // Colorful bars
                    }
                },
                dataLabels: {
                    enabled: false
                },
                legend: {
                    show: false
                },
                xaxis: {
                    categories: <?php echo json_encode(collect($chartData)->pluck('day'), 15, 512) ?>,
                    labels: {
                        style: {
                            fontSize: '12px',
                            fontWeight: 600,
                        }
                    },
                    axisBorder: { show: false },
                    axisTicks: { show: false }
                },
                yaxis: {
                    labels: {
                        style: {
                            fontSize: '12px',
                            fontWeight: 600,
                        }
                    }
                },
                grid: {
                    strokeDashArray: 4,
                    padding: {
                        top: 0,
                        right: 0,
                        bottom: 0,
                        left: 10
                    }
                },
                colors: ['#0d6efd', '#6610f2', '#6f42c1', '#d63384', '#dc3545', '#fd7e14', '#ffc107', '#198754', '#20c997', '#0dcaf0'],
                tooltip: {
                    theme: 'light',
                    y: {
                        formatter: function (val) {
                            return val + " Hafalan"
                        }
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#hafalanChart"), options);
            chart.render();
        });
    </script>

        
        <div class="col-lg-4">
            
            
            <div class="card border-0 shadow-sm rounded-3 mb-4">
                <div class="card-header bg-white border-0 py-3">
                    <h6 class="fw-bold mb-0">Akses Cepat</h6>
                </div>
                <div class="card-body">
                    <div class="row g-2">
                        <div class="col-6">
                            <a href="<?php echo e(route('ustadz.hafalan')); ?>" class="quick-action-btn">
                                <i class="bi bi-plus-circle fs-3 mb-2 text-primary"></i>
                                <span class="small fw-bold">Input Hafalan</span>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="#" class="quick-action-btn">
                                <i class="bi bi-calendar-check fs-3 mb-2 text-success"></i>
                                <span class="small fw-bold">Absensi</span>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="#" class="quick-action-btn">
                                <i class="bi bi-journal-text fs-3 mb-2 text-warning"></i>
                                <span class="small fw-bold">Laporan</span>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="#" class="quick-action-btn">
                                <i class="bi bi-gear fs-3 mb-2 text-secondary"></i>
                                <span class="small fw-bold">Pengaturan</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="card border-0 shadow-sm rounded-3 mb-4">
                <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold mb-0 text-danger">Belum Setor Hari Ini</h6>
                    <span class="badge bg-danger rounded-pill"><?php echo e($santriButuhPerhatian->count()); ?></span>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush" style="max-height: 300px; overflow-y: auto;">
                        <?php $__empty_1 = true; $__currentLoopData = $santriButuhPerhatian; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-4 py-3">
                                <div>
                                    <div class="fw-bold"><?php echo e($s->nama); ?></div>
                                    <small class="text-muted">Terakhir: <?php echo e($s->last_activity); ?></small>
                                </div>
                                <button class="btn btn-sm btn-outline-danger rounded-circle">
                                    <i class="bi bi-bell"></i>
                                </button>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <li class="list-group-item text-center text-muted py-3">
                                <i class="bi bi-check-circle text-success fs-4 d-block mb-1"></i>
                                Alhamdulillah, semua sudah setor hari ini!
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

            
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-white border-0 py-3">
                    <h6 class="fw-bold mb-0">Jadwal Mengajar</h6>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <?php $__empty_1 = true; $__currentLoopData = $jadwalHariIni; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <li class="list-group-item px-4 py-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="fw-bold"><?php echo e($j->mapel); ?></span>
                                    <span class="badge bg-<?php echo e($j->badge); ?>"><?php echo e($j->status); ?></span>
                                </div>
                                <div class="d-flex justify-content-between text-muted small">
                                    <span><i class="bi bi-people me-1"></i> <?php echo e($j->kelas->nama ?? '-'); ?></span>
                                    <span><i class="bi bi-clock me-1"></i> <?php echo e(\Carbon\Carbon::parse($j->jam_mulai)->format('H:i')); ?></span>
                                </div>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <li class="list-group-item text-center text-muted py-3">
                                Tidak ada jadwal dalam waktu dekat.
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>
<?php /**PATH C:\xampp\ImamMuzani\resources\views/livewire/ustadz/berandaustadz.blade.php ENDPATH**/ ?>