@extends('layouts.dashboard')
@section('page-title', 'Edit Laporan')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header bg-white py-3">
                <h5 class="fw-bold mb-0 text-warning"><i class="bi bi-pencil-square me-2"></i>Edit Laporan</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.laporan.update', $laporan->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Judul Laporan <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul', $laporan->judul) }}">
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Penulis <span class="text-danger">*</span></label>
                            <input type="text" name="penulis" class="form-control @error('penulis') is-invalid @enderror" value="{{ old('penulis', $laporan->penulis) }}" readonly>
                            @error('penulis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tanggal <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal', $laporan->tanggal) }}">
                            @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Isi Laporan <span class="text-danger">*</span></label>
                        <textarea name="isi" class="form-control @error('isi') is-invalid @enderror" rows="6">{{ old('isi', $laporan->isi) }}</textarea>
                        @error('isi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('admin.laporan.index') }}" class="btn btn-light border">Batal</a>
                        <button type="submit" class="btn btn-warning px-4"><i class="bi bi-save me-1"></i> Update Laporan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
