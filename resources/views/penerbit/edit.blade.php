@extends('main')

@section('title', 'Edit Penerbit')

@section('content')
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Form Edit Penerbit</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('penerbit.update', $penerbit->idPenerbit) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">ID Penerbit</label>
                        <input type="text" class="form-control" value="{{ $penerbit->idPenerbit }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Penerbit</label>
                        <input type="text" name="nama" class="form-control" value="{{ $penerbit->nama }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control" rows="2">{{ $penerbit->alamat }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No Telepon</label>
                        <input type="text" name="no_telp" class="form-control" value="{{ $penerbit->no_telp }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $penerbit->email }}">
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('penerbit.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection