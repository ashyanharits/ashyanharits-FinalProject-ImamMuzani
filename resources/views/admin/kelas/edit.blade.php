@extends('layouts.dashboard')
@section('page-title', 'Edit Kelas')

@section('content')
<h4 class="fw-bold mb-3">Edit Kelas</h4>

<form action="{{ route('admin.kelas.update', $kelas->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nama Kelas</label>
        <input type="text" name="nama_kelas" class="form-control" value="{{ old('nama_kelas', $kelas->nama_kelas) }}">
    </div>

    <div class="mb-3">
        <label>Pelajaran</label>
        <input type="text" name="pelajaran" class="form-control" value="{{ old('pelajaran', $kelas->pelajaran) }}">
    </div>

    <div class="mb-3">
        <label>Wali Kelas</label>
        <input type="text" name="wali_kelas" class="form-control" value="{{ old('wali_kelas', $kelas->wali_kelas) }}">
    </div>

    <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-control">
            <option value="aktif" {{ old('status', $kelas->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
            <option value="cuti" {{ old('status', $kelas->status) == 'cuti' ? 'selected' : '' }}>Cuti</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Keterangan</label>
        <textarea name="keterangan" class="form-control">{{ old('keterangan', $kelas->keterangan) }}</textarea>
    </div>

    <button class="btn btn-primary">Update</button>
    <a href="{{ route('admin.kelas.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
