@extends('layouts.dashboard')

@section('page-title', 'Tambah Jadwal')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body">
        <form action="{{ route('admin.jadwal.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Kelas</label>
                <select name="kelas_id" class="form-control" required>
    @foreach ($kelas as $k)
        <option value="{{ $k->id }}" 
            {{ $jadwal->kelas_id == $k->id ? 'selected' : '' }}>
            {{ $k->nama_kelas }} — ({{ $k->pelajaran }})
        </option>
    @endforeach
</select>

            </div>

            <div class="mb-3">
                <label>Ustadz</label>
                <select name="ustadz_id" class="form-control" required>
                    @foreach ($ustadz as $u)
                        <option value="{{ $u->id }}">{{ $u->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Hari</label>
                <input type="text" name="hari" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Jam Mulai</label>
                <input type="time" name="jam_mulai" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Jam Selesai</label>
                <input type="time" name="jam_selesai" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
</div>
@endsection
