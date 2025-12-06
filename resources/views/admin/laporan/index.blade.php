@extends('layouts.dashboard')

@section('page-title', 'Data Laporan')

@section('content')
<div class="card shadow-sm border-0 rounded-3">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <div>
            <h5 class="fw-bold mb-0 text-primary"><i class="bi bi-file-earmark-text me-2"></i>Daftar Laporan</h5>
            <small class="text-muted">Pantau laporan dan aktivitas terbaru.</small>
        </div>
        <a href="{{ route('admin.laporan.create') }}" class="btn btn-primary btn-sm rounded-pill px-3">
            <i class="bi bi-plus-lg me-1"></i> Buat Laporan
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
                        <th class="py-3">Judul Laporan</th>
                        <th class="py-3">Penulis</th>
                        <th class="py-3">Tanggal</th>
                        <th class="py-3">Ringkasan Isi</th>
                        <th class="py-3 text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($laporan as $index => $item)
                    <tr>
                        <td class="ps-4 fw-bold text-muted">{{ $index + 1 }}</td>
                        <td>
                            <div class="fw-bold text-dark">{{ $item->judul }}</div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-circle bg-light text-primary me-2 small fw-bold" style="width:32px; height:32px; display:flex; align-items:center; justify-content:center; border-radius:50%;">
                                    {{ substr($item->penulis ?? 'U', 0, 1) }}
                                </div>
                                <span class="fw-semibold">{{ $item->penulis ?? 'Admin' }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center text-muted">
                                <i class="bi bi-calendar3 me-2 small"></i>
                                {{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->format('d M Y') : '-' }}
                            </div>
                        </td>
                        <td class="text-muted small" style="max-width: 300px;">
                            <span class="d-inline-block text-truncate" style="max-width: 100%;">
                                {{ Str::limit($item->isi, 60) ?? '-' }}
                            </span>
                        </td>
                        <td class="text-end pe-4">
                            <div class="btn-group">
                                <a href="{{ route('admin.laporan.edit', $item->id) }}" class="btn btn-outline-warning btn-sm" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('admin.laporan.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm rounded-end" onclick="return confirm('Yakin hapus laporan ini?')" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <div class="d-flex flex-column align-items-center">
                                <div class="bg-light rounded-circle p-3 mb-3">
                                    <i class="bi bi-clipboard-x fs-1 opacity-50"></i>
                                </div>
                                <h6 class="fw-bold">Belum ada laporan</h6>
                                <small>Data laporan akan muncul di sini.</small>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    {{-- Pagination if available --}}
    @if(method_exists($laporan, 'links'))
    <div class="card-footer bg-white border-top-0 py-3">
        {{ $laporan->links() }}
    </div>
    @endif
</div>
@endsection
