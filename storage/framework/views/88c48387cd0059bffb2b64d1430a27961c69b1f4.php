

<?php $__env->startSection('page-title', 'Data Ustadz'); ?>

<?php $__env->startSection('content'); ?>


<?php if(session('success')): ?>
    <div id="alert-success"
        class="alert alert-success shadow-sm position-fixed top-0 end-0 m-3 px-3 py-2 rounded-3 fw-semibold"
        style="z-index: 9999; width: auto; max-width: 300px; opacity: 0; transform: translateX(100%); transition: all 0.5s ease;">
        <?php echo e(session('success')); ?>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const alert = document.getElementById('alert-success');
            if (alert) {
                setTimeout(() => {
                    alert.style.opacity = 1;
                    alert.style.transform = "translateX(0)";
                }, 100);
                setTimeout(() => {
                    alert.style.opacity = 0;
                    alert.style.transform = "translateX(100%)";
                    setTimeout(() => alert.remove(), 600);
                }, 3000);
            }
        });
    </script>
<?php endif; ?>


<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h4 class="fw-bold text-primary mb-0"><i class="bi bi-person-badge"></i> Data Ustadz</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Ustadz</li>
            </ol>
        </nav>
    </div>
    <a href="<?php echo e(route('admin.ustadz.create')); ?>" class="btn btn-primary shadow-sm">
        <i class="bi bi-plus-circle me-1"></i> Tambah Ustadz
    </a>
</div>


<div class="input-group mb-3">
    <span class="input-group-text bg-primary text-white"><i class="bi bi-search"></i></span>
    <input type="text" id="searchInput" class="form-control" placeholder="Cari nama ustadz...">
</div>


<div class="alert alert-info py-2 mb-3 shadow-sm d-flex justify-content-between align-items-center">
    <div>
        <i class="bi bi-people-fill"></i>
        Total Ustadz Terdaftar: <strong id="total-count"><?php echo e($ustadz->count()); ?></strong>
    </div>
    <div class="small text-muted">
        <span id="filtered-count"></span>
    </div>
</div>


<div class="card shadow-sm border-0">
    <div class="card-body">
        <?php if($ustadz->isEmpty()): ?>
            <p class="text-center text-muted my-3">Belum ada data ustadz.</p>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>No HP</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="ustadzTable">
                        <?php $__currentLoopData = $ustadz; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($index + 1); ?></td>
                                <td class="fw-semibold text-start ustadz-nama">
                                    <i class="bi bi-person-circle text-primary me-1"></i>
                                    <span class="ustadz-text"><?php echo e($u->nama); ?></span>
                                </td>
                                <td><?php echo e($u->alamat ?? '-'); ?></td>
                                <td><?php echo e($u->no_hp ?? '-'); ?></td>
                                <td>
                                    <a href="<?php echo e(route('admin.ustadz.edit', $u->id)); ?>" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <form action="<?php echo e(route('admin.ustadz.destroy', $u->id)); ?>" method="POST"
                                        class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus ustadz ini?')">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>


<style>
    table tbody tr {
        transition: all 0.25s ease;
    }

    table tbody tr:hover {
        background-color: #f1f8ff !important;
        transform: scale(1.01);
    }

    #alert-success {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .highlight {
        background-color: #fff3cd;
        border-radius: 3px;
        padding: 0 2px;
    }
</style>


<script>
document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('searchInput');
    const rows = document.querySelectorAll('#ustadzTable tr');
    const filteredCount = document.getElementById('filtered-count');
    const totalCount = <?php echo e($ustadz->count()); ?>;

    searchInput.addEventListener('keyup', function () {
        const keyword = this.value.toLowerCase();
        let visibleCount = 0;

        rows.forEach(row => {
            const nameCell = row.querySelector('.ustadz-text');
            const nameText = nameCell.textContent.toLowerCase().trim();

            // reset highlight
            nameCell.innerHTML = nameCell.textContent;

            // tampilkan hanya yang huruf depannya cocok
            if (keyword === '' || nameText.startsWith(keyword)) {
                row.style.display = '';
                visibleCount++;

                // highlight huruf depan
                if (keyword && nameText.startsWith(keyword)) {
                    const regex = new RegExp(`^(${keyword})`, 'i');
                    nameCell.innerHTML = nameCell.textContent.replace(regex, '<span class="highlight">$1</span>');
                }

            } else {
                row.style.display = 'none';
            }
        });

        // tampilkan jumlah hasil
        filteredCount.innerHTML = keyword.length > 0
            ? `Menampilkan <strong>${visibleCount}</strong> dari ${totalCount} hasil`
            : '';
    });
});
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\ImamMuzani\resources\views/admin/ustadz/index.blade.php ENDPATH**/ ?>