@extends('main')

@section('title', 'Edit Rak Buku')

@section('content')
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Form Edit Rak Buku</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('rak-buku.update', $rakBuku->idRak) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">ID Rak</label>
                        <input type="text" class="form-control" value="{{ $rakBuku->idRak }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kode Rak</label>
                        <input type="text" name="kodeRak" class="form-control" value="{{ $rakBuku->kodeRak }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Lokasi</label>
                        <input type="text" name="lokasi" class="form-control" value="{{ $rakBuku->lokasi }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Lantai</label>
                        <input type="number" name="lantai" class="form-control" value="{{ $rakBuku->lantai }}" required>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('rak-buku.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection