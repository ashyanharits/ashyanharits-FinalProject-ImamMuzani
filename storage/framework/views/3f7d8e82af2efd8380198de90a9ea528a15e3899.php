
<div class="container-fluid p-4">

    <?php if(!$isDetailMode): ?>
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold text-primary">Data Hafalan Santri</h3>
                <p class="text-muted mb-0">Pilih santri untuk melihat detail dan menambah hafalan.</p>
            </div>
        </div>

        
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-2">
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-0 ps-3">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input wire:model.debounce.300ms="search" type="text" class="form-control border-0 bg-transparent" placeholder="Cari nama santri...">
                </div>
            </div>
        </div>

        
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3 text-uppercase text-muted small fw-bold">No</th>
                            <th class="py-3 text-uppercase text-muted small fw-bold">Nama Santri</th>
                            <th class="py-3 text-uppercase text-muted small fw-bold">Halaqah</th>
                            <th class="py-3 text-uppercase text-muted small fw-bold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $santris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="ps-4 fw-bold text-muted"><?php echo e($santris->firstItem() + $index); ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-initial rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; font-weight: bold;">
                                            <?php echo e(substr($s->nama, 0, 1)); ?>

                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-bold text-dark"><?php echo e($s->nama); ?></h6>
                                            <small class="text-muted"><?php echo e($s->kelas ?? 'Belum ada kelas'); ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-primary border border-primary rounded-pill px-3 py-2">
                                        <i class="bi bi-person-badge me-1"></i>
                                        <?php echo e($s->ustadz->nama ?? 'Belum ditentukan'); ?>

                                    </span>
                                </td>
                                <td class="text-center">
                                    <button wire:click="selectSantri(<?php echo e($s->id); ?>)" class="btn btn-light text-primary btn-sm rounded-circle p-2 shadow-sm" title="Lihat Detail">
                                        <i class="bi bi-eye-fill fs-5"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <img src="https://cdn-icons-png.flaticon.com/512/7486/7486754.png" alt="Empty" style="width: 64px; opacity: 0.5;" class="mb-3">
                                    <p class="mb-0">Tidak ada data santri ditemukan.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-white border-0 py-3">
                <?php echo e($santris->links()); ?>

            </div>
        </div>

    <?php else: ?>
        
        <div class="d-flex align-items-center mb-4">
            <button wire:click="backToList" class="btn btn-light rounded-circle shadow-sm me-3 p-2">
                <i class="bi bi-arrow-left fs-5"></i>
            </button>
            <div>
                <h3 class="fw-bold text-primary mb-0"><?php echo e($santri->nama); ?></h3>
                <p class="text-muted mb-0">Input hafalan baru dan riwayat setoran.</p>
            </div>
        </div>

        <div class="row g-4">
            
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                        <h5 class="fw-bold text-dark mb-0">
                            <i class="bi bi-plus-circle-fill text-primary me-2"></i>Tambah Hafalan
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <form wire:submit.prevent="store">
                            
                            
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted text-uppercase">Tanggal</label>
                                <input wire:model="tanggal" type="date" class="form-control bg-light border-0">
                                <?php $__errorArgs = ['tanggal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger small"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            
                            <div class="row g-2 mb-3">
                                <div class="col-4">
                                    <label class="form-label small fw-bold text-muted text-uppercase">Juz</label>
                                    <select wire:model="juz" class="form-select bg-light border-0">
                                        <option value="">Pilih</option>
                                        <?php for($i = 1; $i <= 30; $i++): ?>
                                            <option value="<?php echo e($i); ?>">Juz <?php echo e($i); ?></option>
                                        <?php endfor; ?>
                                    </select>
                                    <?php $__errorArgs = ['juz'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger small"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-8">
                                    <label class="form-label small fw-bold text-muted text-uppercase">Surat</label>
                                    <select wire:model="surat" class="form-select bg-light border-0">
                                        <option value="">Pilih Surat</option>
                                        <?php $__currentLoopData = $surahs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($s); ?>"><?php echo e($s); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['surat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger small"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted text-uppercase">Halaman (Manual)</label>
                                <input wire:model="halaman" type="text" class="form-control bg-light border-0" placeholder="Contoh: 124">
                                <?php $__errorArgs = ['halaman'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger small"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted text-uppercase d-block">Capaian Hafalan</label>
                                <div class="btn-group w-100 mb-2" role="group">
                                    <input type="radio" class="btn-check" name="jenis_input" id="opt_halaman" value="halaman" wire:model="jenis_input">
                                    <label class="btn btn-outline-primary" for="opt_halaman">Per Halaman</label>

                                    <input type="radio" class="btn-check" name="jenis_input" id="opt_baris" value="baris" wire:model="jenis_input">
                                    <label class="btn btn-outline-primary" for="opt_baris">Per Baris</label>
                                </div>

                                <?php if($jenis_input == 'halaman'): ?>
                                    <select wire:model="total_halaman" class="form-select bg-light border-0">
                                        <option value="">-- Berapa Halaman? --</option>
                                        <?php for($i = 1; $i <= 20; $i++): ?>
                                            <option value="<?php echo e($i); ?>"><?php echo e($i); ?> Halaman</option>
                                        <?php endfor; ?>
                                    </select>
                                    <?php $__errorArgs = ['total_halaman'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger small"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <?php else: ?>
                                    <select wire:model="total_baris" class="form-select bg-light border-0">
                                        <option value="">-- Berapa Baris? --</option>
                                        <?php for($i = 1; $i <= 15; $i++): ?>
                                            <option value="<?php echo e($i); ?>"><?php echo e($i); ?> Baris</option>
                                        <?php endfor; ?>
                                    </select>
                                    <?php $__errorArgs = ['total_baris'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger small"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <?php endif; ?>
                            </div>

                            
                            <div class="mb-4">
                                <label class="form-label small fw-bold text-muted text-uppercase">Catatan</label>
                                <textarea wire:model="catatan_ustadz" class="form-control bg-light border-0" rows="3" placeholder="Evaluasi ustadz..."></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-2 fw-bold shadow-sm">
                                <i class="bi bi-save me-2"></i>Simpan Hafalan
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white border-0 pt-4 px-4 pb-0 d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold text-dark mb-0">
                            <i class="bi bi-clock-history text-primary me-2"></i>Riwayat Hafalan
                        </h5>
                    </div>
                    <div class="card-body p-0 mt-3">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="ps-4 py-3">Tanggal</th>
                                        <th class="py-3">Hafalan</th>
                                        <th class="py-3">Capaian</th>
                                        <th class="pe-4 py-3">Catatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $santri->hafalan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td class="ps-4 text-muted small" style="white-space: nowrap;">
                                                <?php echo e(\Carbon\Carbon::parse($h->tanggal)->format('d M Y')); ?>

                                            </td>
                                            <td>
                                                <span class="fw-bold text-dark d-block"><?php echo e($h->nama_hafalan); ?></span>
                                                <small class="text-muted">Juz <?php echo e($h->juz); ?> • Hal <?php echo e($h->halaman); ?></small>
                                            </td>
                                            <td>
                                                <?php if($h->total_halaman): ?>
                                                    <span class="badge  bg-opacity-10 text-success rounded-pill px-3">
                                                        <?php echo e($h->total_halaman); ?> Halaman
                                                    </span>
                                                <?php elseif($h->total_baris): ?>
                                                    <span class="badge bg-opacity-10 text-info rounded-pill px-3">
                                                        <?php echo e($h->total_baris); ?> Baris
                                                    </span>
                                                <?php else: ?>
                                                    <span class="text-muted">-</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="pe-4 text-muted small">
                                                <?php echo e(Str::limit($h->catatan_ustadz, 30) ?: '-'); ?>

                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="4" class="text-center py-5 text-muted">
                                                Belum ada riwayat hafalan.
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    
    <?php if(session()->has('message')): ?>
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div class="toast show align-items-center text-white bg-success border-0 shadow-lg" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="bi bi-check-circle-fill me-2"></i> <?php echo e(session('message')); ?>

                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
    <?php endif; ?>

</div>
<?php /**PATH C:\xampp\ImamMuzani\resources\views/livewire/ustadz/hafalan.blade.php ENDPATH**/ ?>