@extends('layouts.dashboard')
@section('page-title', 'Daftar Kelas')

@section('content')
<div class="card shadow-sm border-0 rounded-3">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <div>
            <h5 class="fw-bold mb-0 text-primary"><i class="bi bi-building me-2"></i>Daftar Kelas</h5>
            <small class="text-muted">Kelola data kelas dan wali kelas.</small>
        </div>
        <a href="{{ route('admin.kelas.create') }}" class="btn btn-primary btn-sm rounded-pill px-3">
            <i class="bi bi-plus-lg me-1"></i> Tambah Kelas
        </a>
    </div>
    <div class="card-body p-0">
        @if(session('success'))
            <div class="alert alert-success m-3 alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

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
                    @forelse($kelas as $index => $k)
                        <tr>
                            <td class="ps-4 fw-bold text-muted">{{ $kelas->firstItem() + $index }}</td>
                            <td>
                                <div class="fw-bold text-dark">{{ $k->nama_kelas }}</div>
                            </td>
                            <td>
                                <span class="badge bg-opacity-10 text-info border border-info rounded-pill px-3">
                                    {{ $k->pelajaran }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-circle bg-light text-primary me-2 small fw-bold" style="width:28px; height:28px; display:flex; align-items:center; justify-content:center; border-radius:50%;">
                                        {{ substr($k->wali_kelas ?? '?', 0, 1) }}
                                    </div>
                                    <span>{{ $k->wali_kelas ?? '-' }}</span>
                                </div>
                            </td>
                            <td class="text-center">
                                @if(strtolower($k->status) == 'aktif')
                                    <span class="badge bg-opacity-10 text-success px-2 py-1 rounded-2">Aktif</span>
                                @else
                                    <span class="badge bg-opacity-10 text-secondary px-2 py-1 rounded-2">Non-Aktif</span>
                                @endif
                            </td>
                            <td class="text-muted small text-truncate" style="max-width: 150px;">
                                {{ $k->keterangan ?? '-' }}
                            </td>
                            <td class="text-end pe-4">
                                <div class="btn-group">
                                    <a href="{{ route('admin.kelas.edit', $k->id) }}" class="btn btn-outline-warning btn-sm" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('admin.kelas.destroy', $k->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger btn-sm rounded-end" onclick="return confirm('Yakin hapus kelas ini?')" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-2 opacity-50"></i>
                                <p class="mb-0">Belum ada data kelas.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white border-top-0 py-3">
        {{ $kelas->links() }}
    </div>
</div>
@endsection
