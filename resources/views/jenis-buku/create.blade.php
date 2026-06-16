@extends('main')

@section('title', 'Tambah Jenis Buku')

@section('content')
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Form Tambah Jenis Buku</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('jenis-buku.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">ID Jenis</label>
                        <input type="text" name="idJenis" class="form-control" value="{{ $newId }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Jenis</label>
                        <input type="text" name="namaJenis" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('jenis-buku.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection