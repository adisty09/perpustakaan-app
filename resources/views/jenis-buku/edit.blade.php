@extends('main')

@section('title', 'Edit Jenis Buku')

@section('content')
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Form Edit Jenis Buku</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('jenis-buku.update', $jenisBuku->idJenis) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">ID Jenis</label>
                        <input type="text" class="form-control" value="{{ $jenisBuku->idJenis }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Jenis</label>
                        <input type="text" name="namaJenis" class="form-control" value="{{ $jenisBuku->namaJenis }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="2">{{ $jenisBuku->deskripsi }}</textarea>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('jenis-buku.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection