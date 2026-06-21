@extends('main')

@section('title', 'Tambah Buku')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Form Tambah Buku</h5>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- FORM TAMBAH BUKU (BUKAN EDIT) --}}
                <form action="{{ route('buku.store') }}" method="POST">
                    @csrf
                    {{-- @method('PUT') TIDAK PAKAI! --}}

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">ID Buku</label>
                                <input type="text" name="idBuku" class="form-control" value="{{ $newId }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">ISBN</label>
                                <input type="text" name="isbn" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Judul Buku <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control" required>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Tahun Terbit <span class="text-danger">*</span></label>
                                <input type="number" name="tahunTerbit" class="form-control" min="1900" max="{{ date('Y') }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Stok Total <span class="text-danger">*</span></label>
                                <input type="number" name="stok_total" class="form-control" min="0" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Stok Tersedia <span class="text-danger">*</span></label>
                                <input type="number" name="stok_tersedia" class="form-control" min="0" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Penerbit <span class="text-danger">*</span></label>
                                <select name="idPenerbit" class="form-select" required>
                                    <option value="">Pilih Penerbit</option>
                                    @foreach($penerbits as $penerbit)
                                        <option value="{{ $penerbit->idPenerbit }}">{{ $penerbit->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Jenis Buku <span class="text-danger">*</span></label>
                                <select name="idJenis" class="form-select" required>
                                    <option value="">Pilih Jenis</option>
                                    @foreach($jenisBukus as $jenis)
                                        <option value="{{ $jenis->idJenis }}">{{ $jenis->namaJenis }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Pengarang</label>
                                <select name="idPengarang" class="form-select">
                                    <option value="">Pilih Pengarang</option>
                                    @foreach($pengarangs as $pengarang)
                                        <option value="{{ $pengarang->idPengarang }}">{{ $pengarang->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Rak Buku</label>
                                <select name="idRak" class="form-select">
                                    <option value="">Pilih Rak Buku</option>
                                    @foreach($rakBukus as $rak)
                                        <option value="{{ $rak->idRak }}">{{ $rak->kodeRak }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('buku.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection