@extends('layouts.dashboard')

@section('page-title', 'Tambah Hafalan Santri')

@section('content')

<div class="card shadow-sm border-0">
    <div class="card-body">
        <form action="{{ route('admin.hafalan.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="santri_id" class="form-label">Santri <span class="text-danger">*</span></label>
                <select name="santri_id" id="santri_id" class="form-select @error('santri_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Santri --</option>
                    @foreach($santri as $s)
                        <option value="{{ $s->id }}" {{ old('santri_id') == $s->id ? 'selected' : '' }}>
                            {{ $s->nama }} ({{ $s->kelas->nama_kelas ?? '-' }})
                        </option>
                    @endforeach
                </select>
                @error('santri_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="kelas_id" class="form-label">Kelas</label>
                <select name="kelas_id" id="kelas_id" class="form-select @error('kelas_id') is-invalid @enderror">
                    <option value="">-- Pilih Kelas --</option>
                    @foreach($kelas as $k)
                        <option value="{{ $k->id }}" {{ old('kelas_id') == $k->id ? 'selected' : '' }}>{{ $k->nama_kelas }}</option>
                    @endforeach
                </select>
                @error('kelas_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="ustadz_id" class="form-label">Ustadz</label>
                <select name="ustadz_id" id="ustadz_id" class="form-select @error('ustadz_id') is-invalid @enderror">
                    <option value="">-- Pilih Ustadz --</option>
                    @foreach($ustadz as $u)
                        <option value="{{ $u->id }}" {{ old('ustadz_id') == $u->id ? 'selected' : '' }}>{{ $u->nama }}</option>
                    @endforeach
                </select>
                @error('ustadz_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="nama_hafalan" class="form-label">Nama Hafalan <span class="text-danger">*</span></label>
                <input type="text" name="nama_hafalan" id="nama_hafalan" class="form-control @error('nama_hafalan') is-invalid @enderror" value="{{ old('nama_hafalan') }}" required>
                @error('nama_hafalan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                    <option value="belum_mulai" {{ old('status')=='belum_mulai' ? 'selected' : '' }}>Belum Mulai</option>
                    <option value="sedang_hafal" {{ old('status')=='sedang_hafal' ? 'selected' : '' }}>Sedang Hafal</option>
                    <option value="selesai" {{ old('status')=='selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal <span class="text-danger">*</span></label>
                <input type="date" name="tanggal" id="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                @error('tanggal')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="catatan_ustadz" class="form-label">Catatan Ustadz</label>
                <textarea name="catatan_ustadz" id="catatan_ustadz" class="form-control @error('catatan_ustadz') is-invalid @enderror" rows="3">{{ old('catatan_ustadz') }}</textarea>
                @error('catatan_ustadz')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('admin.hafalan.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

@endsection
