@extends('main')

@section('title', 'Edit Pengarang')

@section('content')
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Form Edit Pengarang</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('pengarang.update', $pengarang->idPengarang) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">ID Pengarang</label>
                        <input type="text" class="form-control" value="{{ $pengarang->idPengarang }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Pengarang</label>
                        <input type="text" name="nama" class="form-control" value="{{ $pengarang->nama }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Negara</label>
                        <input type="text" name="negara" class="form-control" value="{{ $pengarang->negara }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" class="form-control" value="{{ $pengarang->tgl_lahir }}">
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('pengarang.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection