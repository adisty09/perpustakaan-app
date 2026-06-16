@extends('main')

@section('title', 'Edit Anggota')

@section('content')
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Form Edit Anggota</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('anggota.update', $anggota->idAnggota) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">ID Anggota</label>
                        <input type="text" class="form-control" value="{{ $anggota->idAnggota }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" value="{{ old('nama', $anggota->nama) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control" rows="2">{{ $anggota->alamat }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No Telepon</label>
                        <input type="text" name="no_telp" class="form-control" value="{{ $anggota->no_telp }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $anggota->email }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal Daftar</label>
                        <input type="date" name="tgl_daftar" class="form-control" value="{{ $anggota->tgl_daftar }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="Aktif" {{ $anggota->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Non-Aktif" {{ $anggota->status == 'Non-Aktif' ? 'selected' : '' }}>Non-Aktif</option>
                        </select>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('anggota.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection