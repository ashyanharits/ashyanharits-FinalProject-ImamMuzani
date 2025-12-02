@extends('layouts.dashboard')

@section('page-title', 'Data Laporan')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Laporan</h5>
        <a href="#" class="btn btn-light btn-sm text-primary fw-bold">
            <i class="bi bi-plus-circle"></i> Tambah Laporan
        </a>
    </div>

    <div class="card-body">
        <table class="table table-striped table-bordered">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Tanggal</th>
                    <th>Isi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($laporan as $index => $laporan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $laporan->judul }}</td>
                    <td>{{ $laporan->penulis ?? '-' }}</td>
                    <td>{{ $laporan->tanggal ? \Carbon\Carbon::parse($laporan->tanggal)->format('d M Y') : '-' }}</td>
                    <td>{{ Str::limit($laporan->isi, 50) ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Belum ada data laporan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
