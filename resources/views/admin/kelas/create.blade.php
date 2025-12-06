@extends('layouts.dashboard')
@section('page-title', 'Tambah Kelas Baru')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header bg-white py-3">
                <h5 class="fw-bold mb-0 text-primary"><i class="bi bi-plus-circle me-2"></i>Tambah Kelas Baru</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.kelas.store') }}" method="POST">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama Kelas <span class="text-danger">*</span></label>
                            <input type="text" name="nama_kelas" class="form-control @error('nama_kelas') is-invalid @enderror" value="{{ old('nama_kelas') }}" placeholder="Contoh: X-A">
                            @error('nama_kelas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Mata Pelajaran <span class="text-danger">*</span></label>
                            <input type="text" name="pelajaran" class="form-control @error('pelajaran') is-invalid @enderror" value="{{ old('pelajaran') }}" placeholder="Contoh: Tahfidz Quran">
                            @error('pelajaran')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Wali Kelas</label>
                            <select name="wali_kelas" class="form-select @error('wali_kelas') is-invalid @enderror">
                                <option value="">-- Pilih Wali Kelas --</option>
                                @foreach($ustadz as $u)
                                    <option value="{{ $u->nama }}" {{ old('wali_kelas') == $u->nama ? 'selected' : '' }}>{{ $u->nama }}</option>
                                @endforeach
                            </select>
                            @error('wali_kelas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text text-muted">Pilih dari daftar Ustadz yang tersedia.</div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Status Kelas</label>
                            <select name="status" class="form-select">
                                <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="non-aktif" {{ old('status') == 'non-aktif' ? 'selected' : '' }}>Non-Aktif</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Keterangan (Opsional)</label>
                            <textarea name="keterangan" class="form-control" rows="3" placeholder="Tambahkan catatan jika perlu...">{{ old('keterangan') }}</textarea>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('admin.kelas.index') }}" class="btn btn-light border">Batal</a>
                        <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save me-1"></i> Simpan Kelas</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
