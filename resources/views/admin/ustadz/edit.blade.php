@extends('layouts.dashboard')

@section('page-title', 'Edit Ustadz')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.ustadz.update', $ustadz->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" value="{{ $ustadz->nama }}" required>
            </div>
            <div class="mb-3">
                <label>Alamat</label>
                <input type="text" name="alamat" class="form-control" value="{{ $ustadz->alamat }}">
            </div>
            <div class="mb-3">
                <label>No HP</label>
                <input type="text" name="no_hp" class="form-control" value="{{ $ustadz->no_hp }}">
            </div>
            <button class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection
