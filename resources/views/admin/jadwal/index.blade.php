@extends('layouts.dashboard')

@section('page-title', 'Jadwal')

@section('content')

{{-- Toastr CSS --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

{{-- Notifikasi --}}
@if (session('success'))
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            toastr.success("{{ session('success') }}");
        });
    </script>
@endif
@if (session('error'))
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            toastr.error("{{ session('error') }}");
        });
    </script>
@endif

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0 fw-bold">📅 Data Jadwal</h4>
    <a href="{{ route('admin.jadwal.create') }}" class="btn btn-primary shadow">
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
@forelse ($jadwal as $index => $j)
    <tr>
        <td class="text-center fw-bold">{{ $index + 1 }}</td>

        {{-- nama kelas --}}
        <td class="text-capitalize">{{ $j->kelas->nama_kelas }}</td>

        {{-- pelajaran --}}
        <td>{{ $j->kelas->pelajaran }}</td>

        {{-- ustadz --}}
        <td>{{ $j->ustadz->nama }}</td>

        <td class="text-capitalize">{{ $j->hari }}</td>
        <td>{{ $j->jam_mulai }} - {{ $j->jam_selesai }}</td>
        
        <td class="text-center">
            <a href="{{ route('admin.jadwal.edit', $j->id) }}" 
               class="btn btn-warning btn-sm shadow-sm me-1">✏️ Edit</a>

            <form action="{{ route('admin.jadwal.destroy', $j->id) }}" 
                  method="POST" class="d-inline-block"
                  onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
                @csrf @method('DELETE')
                <button class="btn btn-danger btn-sm shadow-sm">🗑 Hapus</button>
            </form>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="7" class="text-center text-muted py-3">Belum ada jadwal.</td>
    </tr>
@endforelse
</tbody>

        </table>
    </div>
</div>

<!-- JQuery (wajib untuk toastr) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

{{-- Toastr Script --}}
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

@endsection
