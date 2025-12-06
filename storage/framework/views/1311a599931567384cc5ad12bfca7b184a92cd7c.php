<?php $__env->startSection('page-title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-0">Selamat Datang, <?php echo e(Auth::user()->name ?? 'Admin'); ?> 👋</h3>
        <h3 class="fw-bold mb-0">Dashboard Admin</h3>
        <p class="text-muted mb-0">Ringkasan data dan perkembangan santri Imam Muzani.</p>
    </div>

        
        <div class="bg-white px-3 py-2 rounded-3 shadow-sm border">
            <i class="bi bi-calendar-check text-primary me-2"></i>
            <span class="fw-bold text-dark"><?php echo e(\Carbon\Carbon::now()->translatedFormat('l, d F Y')); ?></span>
        </div>
</div>


<?php
    // pastikan controller mengirimkan $totalSantri, $totalUstadz, $totalKelas, $totalPelajaran
    $totals = [
        ['title'=>'Total Santri','icon'=>'bi-people','color'=>'primary','value'=> $totalSantri ?? 0],
        ['title'=>'Total Ustadz','icon'=>'bi-person-badge','color'=>'success','value'=> $totalUstadz ?? 0],
        ['title'=>'Total Kelas','icon'=>'bi-building','color'=>'warning','value'=> $totalKelas ?? 0],
        ['title'=>'Total Pelajaran','icon'=>'bi-book','color'=>'danger','value'=> $totalPelajaran ?? 0],
    ];
?>

<div class="row g-3 mb-4">
    <?php $__currentLoopData = $totals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-sm-6 col-md-3">
            <div class="card shadow-sm border-0 rounded-3 hover-card p-3 h-100">
                <div class="d-flex align-items-center">
                    <div class="me-3 text-<?php echo e($card['color']); ?> fs-2">
                        <i class="bi <?php echo e($card['icon']); ?>"></i>
                    </div>
                    <div class="flex-grow-1">
                        <small class="text-muted"><?php echo e($card['title']); ?></small>
                        <div class="h4 mb-0">
                            <span class="countup" data-target="<?php echo e($card['value']); ?>"><?php echo e($card['value']); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>


<div class="row g-4">
    
    <div class="col-lg-8">
        
        <div class="card shadow-sm border-0 rounded-3 mb-4">
            <div class="card-header bg-white fw-bold">
                <i class="bi bi-graph-up me-1 text-primary"></i> Statistik Setoran Hafalan
                <small class="text-muted ms-2">(6 Bulan Terakhir)</small>
            </div>
            <div class="card-body">
                <canvas id="santriChart" height="120"></canvas>
            </div>
        </div>

        
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header bg-white fw-bold d-flex justify-content-between align-items-center">
                <span><i class="bi bi-journal-check me-1 text-success"></i> Setoran Hafalan Hari Ini</span>
                <a href="#" class="btn btn-sm btn-light text-primary">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-3">Santri</th>
                                <th>Hafalan</th>
                                <th>Status</th>
                                <th>Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php $__empty_1 = true; $__currentLoopData = $recentSetoran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $setoran): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td class="ps-3">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle bg-light text-primary me-2 fw-bold" style="width:32px; height:32px; display:flex; align-items:center; justify-content:center; border-radius:50%;">
                                                <?php echo e(substr($setoran->name, 0, 1)); ?>

                                            </div>
                                            <span class="fw-semibold"><?php echo e($setoran->name); ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="small fw-bold"><?php echo e($setoran->surat); ?></div>
                                        <div class="small text-muted">Ayat <?php echo e($setoran->ayat); ?></div>
                                    </td>
                                    <td>
                                        <span class="badge bg-opacity-10 text-<?php echo e($setoran->color ?? 'secondary'); ?> px-2 py-1">
                                            <?php echo e($setoran->status); ?>

                                        </span>
                                    </td>
                                    <td class="text-muted small"><?php echo e($setoran->time); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">
                                        <i class="bi bi-calendar-x d-block fs-4 mb-1 opacity-50"></i>
                                        <small>Belum ada setoran hari ini.</small>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-4">
        
        <div class="card shadow-sm border-0 rounded-3 mb-4">
            <div class="card-header bg-white fw-bold">
                <i class="bi bi-pie-chart me-1 text-success"></i> Sebaran Santri per Kelas
            </div>
            <div class="card-body text-center">
                <canvas id="pieChart" height="220"></canvas>
            </div>
        </div>

        
        <div class="card shadow-sm border-0 rounded-3 mb-4">
            <div class="card-header bg-white fw-bold d-flex justify-content-between align-items-center">
                <span><i class="bi bi-envelope-paper me-1 text-info"></i> Laporan Masuk</span>
                <a href="#" class="btn btn-sm btn-light text-primary">Lihat Semua</a>
            </div>
            <div class="card-body p-3">
                <?php if(isset($latestLaporan) && count($latestLaporan) > 0): ?>
                    <div class="d-flex flex-column gap-3">
                        <?php $__currentLoopData = $latestLaporan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $laporan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="p-3 border rounded-3 bg-white position-relative hover-shadow transition-all">
                                <div class="d-flex justify-content-between mb-2">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle bg-primary bg-gradient text-white me-2 small fw-bold shadow-sm" style="width:32px; height:32px; display:flex; align-items:center; justify-content:center; border-radius:50%;">
                                            <?php echo e($laporan->initial); ?>

                                        </div>
                                        <span class="fw-bold text-dark small"><?php echo e($laporan->penulis); ?></span>
                                    </div>
                                    <small class="text-muted" style="font-size: 0.75rem;"><?php echo e($laporan->waktu); ?></small>
                                </div>
                                <h6 class="fw-bold mb-1 text-primary" style="font-size: 0.95rem;"><?php echo e($laporan->judul); ?></h6>
                                <p class="text-muted small mb-0 line-clamp-2" style="line-height: 1.4;"><?php echo e($laporan->isi); ?></p>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-4 text-muted">
                        <i class="bi bi-inbox fs-1 d-block mb-2 opacity-50"></i>
                        <small>Belum ada laporan masuk.</small>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body d-flex flex-column gap-2">
                <a href="<?php echo e(route('admin.ustadz.index')); ?>" class="btn btn-outline-primary btn-sm w-100">
                    <i class="bi bi-person-lines-fill me-1"></i> Data Ustadz
                </a>
                <a href="<?php echo e(route('admin.santri.index')); ?>" class="btn btn-outline-success btn-sm w-100">
                    <i class="bi bi-mortarboard me-1"></i> Data Santri
                </a>
                <a href="<?php echo e(route('admin.kelas.index')); ?>" class="btn btn-outline-warning btn-sm w-100">
                    <i class="bi bi-book-half me-1"></i> Data Pelajaran
                </a>
                <a href="<?php echo e(route('admin.kelas.index')); ?>" class="btn btn-outline-danger btn-sm w-100">
                    <i class="bi bi-door-open me-1"></i> Data Kelas
                </a>
            </div>
        </div>
    </div>
</div>


<div wire:loading class="position-fixed bottom-0 end-0 m-4">
    <div class="spinner-border text-primary" role="status"></div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/countup.js@2.0.7/dist/countUp.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<script>
document.addEventListener('DOMContentLoaded', function() {
    // ===== CountUp animation for summary cards =====
    document.querySelectorAll('.countup').forEach(el => {
        const target = parseInt(el.getAttribute('data-target')) || parseInt(el.textContent) || 0;
        const cu = new countUp.CountUp(el, target, { duration: 1.2, separator: ',' });
        if (!cu.error) cu.start(); else console.error(cu.error);
    });

    // ===== Line Chart (Statistik Setoran) =====
    const months = <?php echo json_encode($months); ?>;
    const santriCounts = <?php echo json_encode($santriCounts); ?>;
    const ctx = document.getElementById('santriChart').getContext('2d');
    const santriChart = new Chart(ctx, {
        type: 'bar', // Changed to bar for better visualization of counts
        data: {
            labels: months,
            datasets: [{
                label: 'Jumlah Setoran',
                data: santriCounts,
                backgroundColor: 'rgba(78, 115, 223, 0.7)',
                borderColor: 'rgba(78, 115, 223, 1)',
                borderWidth: 1,
                borderRadius: 4,
                barPercentage: 0.6
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true, ticks: { precision: 0 } } },
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // ===== Pie Chart (Sebaran Kelas) =====
    const pieLabels = <?php echo json_encode($pieLabels); ?>;
    const pieData = <?php echo json_encode($pieData); ?>;
    const pieCtx = document.getElementById('pieChart').getContext('2d');
    
    // Generate colors dynamically
    const generateColors = (count) => {
        const colors = ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#858796', '#5a5c69'];
        return Array.from({length: count}, (_, i) => colors[i % colors.length]);
    };

    const pie = new Chart(pieCtx, {
        type: 'doughnut',
        data: {
            labels: pieLabels,
            datasets: [{
                data: pieData,
                backgroundColor: generateColors(pieLabels.length),
                hoverOffset: 4
            }]
        },
        options: {
            plugins: { 
                legend: { 
                    position: 'bottom',
                    labels: { boxWidth: 12, usePointStyle: true }
                } 
            },
            cutout: '65%',
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // ===== Theme toggle removed =====

});
</script>


<style>
    /* hover card */
    .hover-card { transition: all 0.28s ease; }
    .hover-card:hover { transform: translateY(-6px); box-shadow: 0 12px 30px rgba(13,110,253,0.06); }

    /* small polish */
    .card-header { border-bottom: 1px solid #f8f9fb; }
    
    .hover-shadow:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        transform: translateY(-2px);
        border-color: #a5b4fc !important;
    }
    .transition-all { transition: all 0.2s ease; }
    
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Dark mode styles removed */


    /* Fix chart height supaya nggak melar */
#santriChart {
    height: 280px !important;
    max-height: 280px !important;
}
#pieChart {
    height: 220px !important;
    max-height: 220px !important;
}
.card-body canvas {
    display: block;
    width: 100% !important;
    height: auto;
}

</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\ImamMuzani\resources\views/livewire/card-dashboard.blade.php ENDPATH**/ ?>