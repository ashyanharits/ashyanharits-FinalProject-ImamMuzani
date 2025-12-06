

<?php $__env->startSection('page-title', 'Data Hafalan Santri'); ?>

<?php $__env->startSection('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0 fw-bold">📋 Data Hafalan Santri</h4>
    <a href="<?php echo e(route('admin.hafalan.create')); ?>" class="btn btn-primary shadow-sm">
        + Tambah Hafalan
    </a>
</div>

<?php if(session('success')): ?>
    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
<?php endif; ?>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <table class="table table-hover table-striped mb-0 align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Santri</th>
                    <th>Kelas</th>
                    <th>Hafalan</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Ustadz</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $hafalan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($hafalan->firstItem() + $index); ?></td>
                    <td><?php echo e($h->santri->nama ?? '-'); ?></td>
                    <td><?php echo e($h->kelas->nama_kelas ?? '-'); ?></td>
                    <td><?php echo e($h->nama_hafalan); ?></td>
                    <td><?php echo e(\Carbon\Carbon::parse($h->tanggal)->format('d M Y')); ?></td>
                    <td>
                        <?php if($h->status === 'selesai'): ?>
                            <span class="badge bg-success">Selesai</span>
                        <?php elseif($h->status === 'sedang_hafal'): ?>
                            <span class="badge bg-warning text-dark">Sedang Hafal</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">Belum Mulai</span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo e($h->ustadz->nama ?? '-'); ?></td>
                    <td class="text-center">
                        <a href="<?php echo e(route('admin.hafalan.edit', $h->id)); ?>" class="btn btn-warning btn-sm me-1">✏️ Edit</a>
                        <form action="<?php echo e(route('admin.hafalan.destroy', $h->id)); ?>" method="POST" class="d-inline-block" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button class="btn btn-danger btn-sm">🗑 Hapus</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="8" class="text-center text-muted py-3">Belum ada data hafalan.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="p-3">
            <?php echo e($hafalan->links()); ?>

        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\ImamMuzani\resources\views/admin/hafalan/index.blade.php ENDPATH**/ ?>