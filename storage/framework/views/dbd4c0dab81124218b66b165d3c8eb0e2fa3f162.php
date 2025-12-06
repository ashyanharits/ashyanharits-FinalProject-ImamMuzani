

<?php $__env->startSection('page-title', 'Edit Santri'); ?>

<?php $__env->startSection('content'); ?>
<div class="card shadow-sm rounded-3">
    <div class="card-body">
        <h5 class="mb-4 fw-bold">Edit Santri</h5>

        
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('admin.santri.update', $santri->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="mb-3">
                <label for="nama" class="form-label">Nama Santri</label>
                <input type="text" name="nama" id="nama" class="form-control" value="<?php echo e(old('nama', $santri->nama)); ?>" required>
            </div>

            <div class="mb-3">
                <label for="ustadz_id" class="form-label">Ustadz Pembimbing <span class="text-danger">*</span></label>
                <select name="ustadz_id" id="ustadz_id" class="form-select" required>
                    <option value="">-- Pilih Ustadz --</option>
                    <?php $__currentLoopData = $ustadz; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($u->id); ?>" <?php echo e(old('ustadz_id', $santri->ustadz_id) == $u->id ? 'selected' : ''); ?>>
                            <?php echo e($u->nama); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" name="alamat" id="alamat" class="form-control" value="<?php echo e(old('alamat', $santri->alamat)); ?>">
            </div>

            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="<?php echo e(old('tanggal_lahir', $santri->tanggal_lahir)); ?>">
            </div>

            <div class="mb-3">
                <label for="kelas" class="form-label">Kelas</label>
                <input type="text" name="kelas" id="kelas" class="form-control" value="<?php echo e(old('kelas', $santri->kelas)); ?>">
            </div>

            <div class="mb-3">
                <label for="no_hp" class="form-label">No HP</label>
                <input type="text" name="no_hp" id="no_hp" class="form-control" value="<?php echo e(old('no_hp', $santri->no_hp)); ?>">
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i> Update
                </button>
                <a href="<?php echo e(route('admin.santri.index')); ?>" class="btn btn-secondary">
                    <i class="bi bi-x-circle me-1"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\ImamMuzani\resources\views/admin/santri/edit.blade.php ENDPATH**/ ?>