
<?php $__env->startSection('page-title', 'Daftar Kelas'); ?>

<?php $__env->startSection('content'); ?>
<div class="card shadow-sm border-0 rounded-3">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <div>
            <h5 class="fw-bold mb-0 text-primary"><i class="bi bi-building me-2"></i>Daftar Kelas</h5>
            <small class="text-muted">Kelola data kelas dan wali kelas.</small>
        </div>
        <a href="<?php echo e(route('admin.kelas.create')); ?>" class="btn btn-primary btn-sm rounded-pill px-3">
            <i class="bi bi-plus-lg me-1"></i> Tambah Kelas
        </a>
    </div>
    <div class="card-body p-0">
        <?php if(session('success')): ?>
            <div class="alert alert-success m-3 alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-secondary">
                    <tr>
                        <th class="ps-4 py-3" width="5%">No</th>
                        <th class="py-3">Nama Kelas</th>
                        <th class="py-3">Mata Pelajaran</th>
                        <th class="py-3">Wali Kelas</th>
                        <th class="py-3 text-center">Status</th>
                        <th class="py-3">Keterangan</th>
                        <th class="py-3 text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $kelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="ps-4 fw-bold text-muted"><?php echo e($kelas->firstItem() + $index); ?></td>
                            <td>
                                <div class="fw-bold text-dark"><?php echo e($k->nama_kelas); ?></div>
                            </td>
                            <td>
                                <span class="badge bg-opacity-10 text-info border border-info rounded-pill px-3">
                                    <?php echo e($k->pelajaran); ?>

                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-circle bg-light text-primary me-2 small fw-bold" style="width:28px; height:28px; display:flex; align-items:center; justify-content:center; border-radius:50%;">
                                        <?php echo e(substr($k->wali_kelas ?? '?', 0, 1)); ?>

                                    </div>
                                    <span><?php echo e($k->wali_kelas ?? '-'); ?></span>
                                </div>
                            </td>
                            <td class="text-center">
                                <?php if(strtolower($k->status) == 'aktif'): ?>
                                    <span class="badge bg-opacity-10 text-success px-2 py-1 rounded-2">Aktif</span>
                                <?php else: ?>
                                    <span class="badge bg-opacity-10 text-secondary px-2 py-1 rounded-2">Non-Aktif</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-muted small text-truncate" style="max-width: 150px;">
                                <?php echo e($k->keterangan ?? '-'); ?>

                            </td>
                            <td class="text-end pe-4">
                                <div class="btn-group">
                                    <a href="<?php echo e(route('admin.kelas.edit', $k->id)); ?>" class="btn btn-outline-warning btn-sm" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="<?php echo e(route('admin.kelas.destroy', $k->id)); ?>" method="POST" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button class="btn btn-outline-danger btn-sm rounded-end" onclick="return confirm('Yakin hapus kelas ini?')" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-2 opacity-50"></i>
                                <p class="mb-0">Belum ada data kelas.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white border-top-0 py-3">
        <?php echo e($kelas->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\ImamMuzani\resources\views/admin/kelas/index.blade.php ENDPATH**/ ?>