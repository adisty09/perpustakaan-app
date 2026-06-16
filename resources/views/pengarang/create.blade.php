@extends('main')

@section('title', 'Tambah Pengarang')

@section('content')
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Form Tambah Pengarang</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('pengarang.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">ID Pengarang</label>
                        <input type="text" name="idPengarang" class="form-control" value="{{ $newId }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Pengarang</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Negara</label>
                        <input type="text" name="negara" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" class="form-control">
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('pengarang.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection