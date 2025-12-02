@extends('layouts.dashboard')

@section('page-title', 'Edit Santri')

@section('content')
<div class="card shadow-sm rounded-3">
    <div class="card-body">
        <h5 class="mb-4 fw-bold">Edit Santri</h5>

        {{-- Tampilkan error validasi --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.santri.update', $santri->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nama" class="form-label">Nama Santri</label>
                <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $santri->nama) }}" required>
            </div>

            <div class="mb-3">
                <label for="ustadz_id" class="form-label">Ustadz Pembimbing <span class="text-danger">*</span></label>
                <select name="ustadz_id" id="ustadz_id" class="form-select" required>
                    <option value="">-- Pilih Ustadz --</option>
                    @foreach($ustadz as $u)
                        <option value="{{ $u->id }}" {{ old('ustadz_id', $santri->ustadz_id) == $u->id ? 'selected' : '' }}>
                            {{ $u->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" name="alamat" id="alamat" class="form-control" value="{{ old('alamat', $santri->alamat) }}">
            </div>

            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $santri->tanggal_lahir) }}">
            </div>

            <div class="mb-3">
                <label for="kelas" class="form-label">Kelas</label>
                <input type="text" name="kelas" id="kelas" class="form-control" value="{{ old('kelas', $santri->kelas) }}">
            </div>

            <div class="mb-3">
                <label for="no_hp" class="form-label">No HP</label>
                <input type="text" name="no_hp" id="no_hp" class="form-control" value="{{ old('no_hp', $santri->no_hp) }}">
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i> Update
                </button>
                <a href="{{ route('admin.santri.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle me-1"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
