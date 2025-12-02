@extends('layouts.dashboard')
@section('page-title', 'Daftar Kelas')

@section('content')
<h4 class="fw-bold mb-3">Daftar Kelas</h4>

<a href="{{ route('admin.kelas.create') }}" class="btn btn-success mb-3">Tambah Kelas</a>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Kelas</th>
            <th>Pelajaran</th>
            <th>Wali Kelas</th>
            <th>Status</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($kelas as $index => $k)
            <tr>
                <td>{{ $kelas->firstItem() + $index }}</td>
                <td>{{ $k->nama_kelas }}</td>
                <td>{{ $k->pelajaran }}</td>
                <td>{{ $k->wali_kelas }}</td>
                <td>{{ ucfirst($k->status) }}</td>
                <td>{{ $k->keterangan }}</td>
                <td>
                    <a href="{{ route('admin.kelas.edit', $k->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.kelas.destroy', $k->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus kelas ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $kelas->links() }}
@endsection
