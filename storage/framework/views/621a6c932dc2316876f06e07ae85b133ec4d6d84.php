<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0 fw-bold">📅 Data Jadwal</h4>
</div>

<div class="card shadow-sm border-0 rounded-3">
    <div class="card-body p-0">
        <table class="table table-hover table-striped mb-0 align-middle">
            <thead class="table-dark">
                <tr>
                    <th class="text-center">#</th>
                    <th>Kelas</th>
                    <th>Pelajaran</th>
                    <th>Hari</th>
                    <th>Jam</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $jadwal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="text-center fw-bold"><?php echo e($index + 1); ?></td>

                        
                        <td class="text-capitalize"><?php echo e($j->kelas->nama_kelas ?? '-'); ?></td>

                        
                        <td><?php echo e($j->kelas->pelajaran ?? '-'); ?></td>

                        <td class="text-capitalize"><?php echo e(\Carbon\Carbon::parse($j->tanggal)->isoFormat('dddd, DD MMM YYYY')); ?></td>
                        <td><?php echo e($j->jam_mulai ?? '-'); ?> - <?php echo e($j->jam_selesai ?? '-'); ?></td>

                        <td>
                            <?php if(\Carbon\Carbon::parse($j->tanggal)->isToday()): ?>
                                <span class="badge bg-success">Hari Ini</span>
                            <?php elseif(\Carbon\Carbon::parse($j->tanggal)->isPast()): ?>
                                <span class="badge bg-secondary">Selesai</span>
                            <?php else: ?>
                                <span class="badge bg-warning">Akan Datang</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted py-3">Belum ada jadwal.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php /**PATH C:\xampp\ImamMuzani\resources\views/livewire/ustadz/jadwal.blade.php ENDPATH**/ ?>