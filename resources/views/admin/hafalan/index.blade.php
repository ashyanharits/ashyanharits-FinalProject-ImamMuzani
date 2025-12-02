@extends('layouts.dashboard')

@section('page-title', 'Data Hafalan Santri')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0 fw-bold">📋 Data Hafalan Santri</h4>
    <a href="{{ route('admin.hafalan.create') }}" class="btn btn-primary shadow-sm">
        + Tambah Hafalan
    </a>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

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
                @forelse ($hafalan as $index => $h)
                <tr>
                    <td>{{ $hafalan->firstItem() + $index }}</td>
                    <td>{{ $h->santri->nama ?? '-' }}</td>
                    <td>{{ $h->kelas->nama_kelas ?? '-' }}</td>
                    <td>{{ $h->nama_hafalan }}</td>
                    <td>{{ \Carbon\Carbon::parse($h->tanggal)->format('d M Y') }}</td>
                    <td>
                        @if($h->status === 'selesai')
                            <span class="badge bg-success">Selesai</span>
                        @elseif($h->status === 'sedang_hafal')
                            <span class="badge bg-warning text-dark">Sedang Hafal</span>
                        @else
                            <span class="badge bg-secondary">Belum Mulai</span>
                        @endif
                    </td>
                    <td>{{ $h->ustadz->nama ?? '-' }}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.hafalan.edit', $h->id) }}" class="btn btn-warning btn-sm me-1">✏️ Edit</a>
                        <form action="{{ route('admin.hafalan.destroy', $h->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">🗑 Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-3">Belum ada data hafalan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="p-3">
            {{ $hafalan->links() }}
        </div>
    </div>
</div>

@endsection
