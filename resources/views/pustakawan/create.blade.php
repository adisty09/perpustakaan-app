@extends('main')

@section('title', 'Tambah Pustakawan')

@section('content')
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Form Tambah Pustakawan</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('pustakawan.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">ID Pustakawan</label>
                        <input type="text" name="idPustakawan" class="form-control" value="{{ $newId }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No Telepon</label>
                        <input type="text" name="no_telp" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jabatan</label>
                        <input type="text" name="jabatan" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gaji Pokok</label>
                        <input type="number" name="gaji_pokok" class="form-control" required>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('pustakawan.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection