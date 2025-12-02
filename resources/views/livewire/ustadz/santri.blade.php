<div class="container-fluid p-4">

    {{-- Header Stats --}}
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-3 bg-primary text-white h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="display-4 me-3"><i class="bi bi-people"></i></div>
                    <div>
                        <h6 class="text-white-50 text-uppercase mb-1">Total Santri</h6>
                        <h2 class="fw-bold mb-0">{{ $totalSantri }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-3 bg-success text-white h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="display-4 me-3"><i class="bi bi-building"></i></div>
                    <div>
                        <h6 class="text-white-50 text-uppercase mb-1">Total Kelas</h6>
                        <h2 class="fw-bold mb-0">{{ $totalKelas }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-3 bg-info text-white h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="display-4 me-3"><i class="bi bi-person-plus"></i></div>
                    <div>
                        <h6 class="text-white-50 text-uppercase mb-1">Santri Baru (Bulan Ini)</h6>
                        <h2 class="fw-bold mb-0">{{ $santriBaru }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Toolbar --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 gap-3">
        <div class="d-flex align-items-center gap-2 w-100 w-md-auto">
            <div class="input-group shadow-sm">
                <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                <input wire:model.debounce.100ms="search" type="text" class="form-control border-start-0" placeholder="Cari nama atau kelas...">
            </div>
        </div>
        <div class="d-flex gap-2">
            <div class="btn-group shadow-sm" role="group">
                <button wire:click="$set('viewMode', 'list')" type="button" class="btn btn-{{ $viewMode == 'list' ? 'primary' : 'light' }}">
                    <i class="bi bi-list-ul"></i>
                </button>
                <button wire:click="$set('viewMode', 'grid')" type="button" class="btn btn-{{ $viewMode == 'grid' ? 'primary' : 'light' }}">
                    <i class="bi bi-grid-fill"></i>
                </button>
            </div>
            <button wire:click="openModal" class="btn btn-primary shadow-sm fw-bold">
                <i class="bi bi-plus-lg me-1"></i> Tambah Santri
            </button>
        </div>
    </div>

    {{-- Flash Message --}}
    {{-- Flash Message (Minimalist Toast) --}}
    @if (session()->has('message'))
        <div x-data="{ show: true }" 
             x-init="setTimeout(() => show = false, 3000)" 
             x-show="show" 
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 transform translate-x-0"
             x-transition:leave-end="opacity-0 transform translate-x-full"
             class="position-fixed top-0 end-0 p-3" style="z-index: 1050">
            <div class="toast show align-items-center text-white bg-success border-0 shadow-lg" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="bi bi-check-circle-fill me-2"></i> {{ session('message') }}
                    </div>
                    <button type="button" @click="show = false" class="btn-close btn-close-white me-2 m-auto" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    {{-- Content --}}
    @if($viewMode == 'list')
        {{-- List View --}}
        <div class="card border-0 shadow-sm rounded-3">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3">Nama Santri</th>
                            <th class="py-3">Kelas</th>
                            <th class="py-3">Kontak</th>
                            <th class="py-3">Tanggal Lahir</th>
                            <th class="py-3">Alamat</th>
                            <th class="text-end pe-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($santris as $santri)
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle bg-primary text-white me-3 rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px;">
                                            {{ substr($santri->nama, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark">{{ $santri->nama }}</div>
                                            <small class="text-muted">ID: {{ $santri->id }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge bg-light text-dark border">{{ $santri->kelas }}</span></td>
                                <td>{{ $santri->no_hp ?? '-' }}</td>
                                <td>
                                    @if($santri->tanggal_lahir)
                                        {{ \Carbon\Carbon::parse($santri->tanggal_lahir)->format('d M Y') }}
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="d-inline-block text-truncate" style="max-width: 150px;" title="{{ $santri->alamat }}">
                                        {{ $santri->alamat ?? '-' }}
                                    </span>
                                </td>
                                <td class="text-end pe-4">
                                    <button wire:click="showDetail({{ $santri->id }})" class="btn btn-sm btn-light text-primary me-1" title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button wire:click="edit({{ $santri->id }})" class="btn btn-sm btn-light text-warning me-1" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button onclick="confirm('Yakin hapus?') || event.stopImmediatePropagation()" wire:click="delete({{ $santri->id }})" class="btn btn-sm btn-light text-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">Belum ada data santri.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-white border-0 py-3">
                {{ $santris->links() }}
            </div>
        </div>
    @else
        {{-- Grid View --}}
        <div class="row g-4">
            @forelse($santris as $santri)
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="card border-0 shadow-sm h-100 rounded-3 position-relative overflow-hidden santri-card">
                        <div class="card-body text-center p-4">
                            <div class="avatar-circle bg-gradient-primary text-white mx-auto mb-3 rounded-circle d-flex align-items-center justify-content-center display-6 fw-bold shadow-sm" style="width: 80px; height: 80px; background: linear-gradient(45deg, #0d6efd, #0dcaf0);">
                                {{ substr($santri->nama, 0, 1) }}
                            </div>
                            <h5 class="fw-bold mb-1">{{ $santri->nama }}</h5>
                            <p class="text-muted mb-3">{{ $santri->kelas }}</p>
                            
                            <div class="d-flex justify-content-center gap-2 mb-4">
                                <span class="badge bg-soft-success text-success"><i class="bi bi-check-circle me-1"></i> Aktif</span>
                                <span class="badge bg-soft-primary text-primary"><i class="bi bi-book me-1"></i> Hafidz</span>
                            </div>

                            <div class="d-flex justify-content-center gap-2">
                                <button wire:click="showDetail({{ $santri->id }})" class="btn btn-outline-primary btn-sm rounded-pill px-3">Detail</button>
                                <button wire:click="edit({{ $santri->id }})" class="btn btn-outline-secondary btn-sm rounded-circle"><i class="bi bi-pencil"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5 text-muted">Belum ada data santri.</div>
            @endforelse
        </div>
        <div class="mt-4">
            {{ $santris->links() }}
        </div>
    @endif

    {{-- Modal Form (Create/Edit) --}}
    @if($isModalOpen)
        <div class="modal fade show d-block" style="background-color: rgba(0,0,0,0.5);" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg rounded-4">
                    <div class="modal-header border-bottom-0 pb-0">
                        <h5 class="modal-title fw-bold">{{ $santri_id ? 'Edit Data Santri' : 'Tambah Santri Baru' }}</h5>
                        <button wire:click="closeModal" type="button" class="btn-close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <form wire:submit.prevent="store">
                            <div class="mb-3">
                                <label class="form-label fw-bold small text-muted">Nama Lengkap</label>
                                <input type="text" wire:model="nama" class="form-control @error('nama') is-invalid @enderror">
                                @error('nama') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-6">
                                    <label class="form-label fw-bold small text-muted">Kelas</label>
                                    <select wire:model="kelas" class="form-select @error('kelas') is-invalid @enderror">
                                        <option value="">Pilih Kelas</option>
                                        <option value="1 SMP">1 SMP</option>
                                        <option value="2 SMP">2 SMP</option>
                                        <option value="3 SMP">3 SMP</option>
                                        <option value="1 SMA">1 SMA</option>
                                        <option value="2 SMA">2 SMA</option>
                                        <option value="3 SMA">3 SMA</option>
                                    </select>
                                    @error('kelas') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-6">
                                    <label class="form-label fw-bold small text-muted">No. HP / WA</label>
                                    <input type="text" wire:model="no_hp" class="form-control @error('no_hp') is-invalid @enderror">
                                    @error('no_hp') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold small text-muted">Tanggal Lahir</label>
                                <input type="date" wire:model="tanggal_lahir" class="form-control">
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-bold small text-muted">Alamat</label>
                                <textarea wire:model="alamat" class="form-control" rows="2"></textarea>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary fw-bold py-2">Simpan Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Modal Detail --}}
    @if($isDetailOpen && $selectedSantri)
        <div class="modal fade show d-block" style="background-color: rgba(0,0,0,0.5);" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="modal-header bg-primary text-white border-bottom-0">
                        <h5 class="modal-title fw-bold"><i class="bi bi-person-lines-fill me-2"></i> Detail Santri</h5>
                        <button wire:click="closeModal" type="button" class="btn-close btn-close-white"></button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="row g-0">
                            <div class="col-md-4 bg-light p-4 text-center border-end">
                                <div class="avatar-circle bg-white text-primary mx-auto mb-3 rounded-circle d-flex align-items-center justify-content-center display-4 fw-bold shadow-sm" style="width: 100px; height: 100px;">
                                    {{ substr($selectedSantri->nama, 0, 1) }}
                                </div>
                                <h5 class="fw-bold mb-1">{{ $selectedSantri->nama }}</h5>
                                <p class="text-muted mb-3">{{ $selectedSantri->kelas }}</p>
                                <hr>
                                <div class="text-start small">
                                    <p class="mb-2"><i class="bi bi-telephone me-2 text-muted"></i> {{ $selectedSantri->no_hp ?? '-' }}</p>
                                    <p class="mb-2"><i class="bi bi-geo-alt me-2 text-muted"></i> {{ $selectedSantri->alamat ?? '-' }}</p>
                                    <p class="mb-0"><i class="bi bi-calendar me-2 text-muted"></i> {{ $selectedSantri->tanggal_lahir ? \Carbon\Carbon::parse($selectedSantri->tanggal_lahir)->format('d M Y') : '-' }}</p>
                                </div>
                            </div>
                            <div class="col-md-8 p-4">
                                <h6 class="fw-bold text-uppercase text-muted mb-3">Riwayat Hafalan Terakhir</h6>
                                <div class="list-group list-group-flush">
                                    @forelse($selectedSantri->hafalan as $h)
                                        <div class="list-group-item px-0 py-3">
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <span class="fw-bold text-primary">{{ $h->nama_hafalan }} : {{ $h->ayat }}</span>
                                                <small class="text-muted">{{ \Carbon\Carbon::parse($h->tanggal)->diffForHumans() }}</small>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <small class="text-muted fst-italic">{{ $h->catatan_ustadz ?? 'Tidak ada catatan' }}</small>
                                                <span class="badge bg-{{ $h->status == 'lancar' ? 'success' : ($h->status == 'selesai' ? 'primary' : 'warning') }} rounded-pill">{{ ucfirst($h->status) }}</span>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="text-center text-muted py-4">Belum ada riwayat hafalan.</div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light border-top-0">
                        <button wire:click="closeModal" class="btn btn-secondary">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>
