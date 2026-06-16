@extends('main')

@section('title', 'Edit Pustakawan')

@section('content')
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Form Edit Pustakawan</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('pustakawan.update', $pustakawan->idPustakawan) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">ID Pustakawan</label>
                        <input type="text" class="form-control" value="{{ $pustakawan->idPustakawan }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" value="{{ $pustakawan->nama }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control" rows="2">{{ $pustakawan->alamat }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No Telepon</label>
                        <input type="text" name="no_telp" class="form-control" value="{{ $pustakawan->no_telp }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jabatan</label>
                        <input type="text" name="jabatan" class="form-control" value="{{ $pustakawan->jabatan }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gaji Pokok</label>
                        <input type="number" name="gaji_pokok" class="form-control" value="{{ $pustakawan->gaji_pokok }}" required>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('pustakawan.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection