@extends('layouts.dashboard')
@section('page-title', 'Tambah Kelas')

@section('content')
<h4 class="fw-bold mb-3">Tambah Kelas</h4>

<form action="{{ route('admin.kelas.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Nama Kelas</label>
        <input type="text" name="nama_kelas" class="form-control" value="{{ old('nama_kelas') }}">
        @error('nama_kelas')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="mb-3">
        <label>Pelajaran</label>
        <input type="text" name="pelajaran" class="form-control" value="{{ old('pelajaran') }}">
        @error('pelajaran')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="mb-3">
        <label>Wali Kelas</label>
        <input type="text" name="wali_kelas" class="form-control" value="{{ old('wali_kelas') }}">
    </div>

    <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-control">
            <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
            <option value="cuti" {{ old('status') == 'cuti' ? 'selected' : '' }}>Cuti</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Keterangan</label>
        <textarea name="keterangan" class="form-control">{{ old('keterangan') }}</textarea>
    </div>

    <button class="btn btn-primary">Simpan</button>
    <a href="{{ route('admin.kelas.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
