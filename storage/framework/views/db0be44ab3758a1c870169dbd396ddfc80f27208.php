

<?php $__env->startSection('page-title', 'Jadwal'); ?>

<?php $__env->startSection('content'); ?>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


<?php if(session('success')): ?>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            toastr.success("<?php echo e(session('success')); ?>");
        });
    </script>
<?php endif; ?>
<?php if(session('error')): ?>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            toastr.error("<?php echo e(session('error')); ?>");
        });
    </script>
<?php endif; ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0 fw-bold">📅 Data Jadwal</h4>
    <a href="<?php echo e(route('admin.jadwal.create')); ?>" class="btn btn-primary shadow">
        + Tambah Jadwal
    </a>
</div>

<div class="card shadow-sm border-0 rounded-3">
    <div class="card-body p-0">
        <table class="table table-hover table-striped mb-0 align-middle">
    <thead class="table-dark">
    <tr>
        <th class="text-center">#</th>
        <th>Kelas</th>
        <th>Pelajaran</th>
        <th>Ustadz</th>
        <th>Hari</th>
        <th>Jam</th>
        <th class="text-center">Aksi</th>
    </tr>
</thead>

<tbody>
<?php $__empty_1 = true; $__currentLoopData = $jadwal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <tr>
        <td class="text-center fw-bold"><?php echo e($index + 1); ?></td>

        
        <td class="text-capitalize"><?php echo e($j->kelas->nama_kelas); ?></td>

        
        <td><?php echo e($j->kelas->pelajaran); ?></td>

        
        <td><?php echo e($j->ustadz->nama); ?></td>

        <td class="text-capitalize"><?php echo e($j->hari); ?></td>
        <td><?php echo e($j->jam_mulai); ?> - <?php echo e($j->jam_selesai); ?></td>
        
        <td class="text-center">
            <a href="<?php echo e(route('admin.jadwal.edit', $j->id)); ?>" 
               class="btn btn-warning btn-sm shadow-sm me-1">✏️ Edit</a>

            <form action="<?php echo e(route('admin.jadwal.destroy', $j->id)); ?>" 
                  method="POST" class="d-inline-block"
                  onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                <button class="btn btn-danger btn-sm shadow-sm">🗑 Hapus</button>
            </form>
        </td>
    </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <tr>
        <td colspan="7" class="text-center text-muted py-3">Belum ada jadwal.</td>
    </tr>
<?php endif; ?>
</tbody>

        </table>
    </div>
</div>

<!-- JQuery (wajib untuk toastr) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    toastr.options = {
        closeButton: true,
        progressBar: true,
        positionClass: "toast-top-right",
        timeOut: 3000
    };
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\ImamMuzani\resources\views/admin/jadwal/index.blade.php ENDPATH**/ ?>