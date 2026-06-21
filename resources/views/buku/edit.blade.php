@extends('main')

@section('title', 'Edit Buku')

@section('content')
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Form Edit Buku</h5>
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

                <form action="{{ route('buku.update', $buku->idBuku) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Kode Buku --}}
                    <div class="mb-3">
                        <label class="form-label">Kode Buku</label>
                        <input type="text" class="form-control bg-light" value="{{ $buku->idBuku }}" readonly>
                        <input type="hidden" name="idBuku" value="{{ $buku->idBuku }}">
                    </div>

                    {{-- Judul Buku --}}
                    <div class="mb-3">
                        <label class="form-label">Judul Buku <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" 
                               value="{{ old('judul', $buku->judul) }}" required>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- PENGARANG --}}
                    <div class="mb-3">
                        <label class="form-label">Pengarang</label>
                        <select name="idPengarang" class="form-control @error('idPengarang') is-invalid @enderror">
                            <option value="">Pilih Pengarang</option>
                            @foreach($pengarangs as $pgr)
                                <option value="{{ $pgr->idPengarang }}" 
                                    {{ old('idPengarang', $buku->idPengarang) == $pgr->idPengarang ? 'selected' : '' }}>
                                    {{ $pgr->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('idPengarang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- PENERBIT --}}
                    <div class="mb-3">
                        <label class="form-label">Penerbit</label>
                        <select name="idPenerbit" class="form-control @error('idPenerbit') is-invalid @enderror">
                            <option value="">Pilih Penerbit</option>
                            @foreach($penerbits as $pnb)
                                <option value="{{ $pnb->idPenerbit }}" 
                                    {{ old('idPenerbit', $buku->idPenerbit) == $pnb->idPenerbit ? 'selected' : '' }}>
                                    {{ $pnb->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('idPenerbit')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- JENIS BUKU --}}
                    <div class="mb-3">
                        <label class="form-label">Jenis Buku</label>
                        <select name="idJenis" class="form-control @error('idJenis') is-invalid @enderror">
                            <option value="">Pilih Jenis Buku</option>
                            @foreach($jenisBukus as $jenis)
                                <option value="{{ $jenis->idJenis }}" 
                                    {{ old('idJenis', $buku->idJenis) == $jenis->idJenis ? 'selected' : '' }}>
                                    {{ $jenis->namaJenis }}
                                </option>
                            @endforeach
                        </select>
                        @error('idJenis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- RAK BUKU --}}
                    <div class="mb-3">
                        <label class="form-label">Rak Buku</label>
                        <select name="idRak" class="form-control @error('idRak') is-invalid @enderror">
                            <option value="">Pilih Rak Buku</option>
                            @foreach($rakBukus as $rak)
                                <option value="{{ $rak->idRak }}" 
                                    {{ old('idRak', $buku->idRak) == $rak->idRak ? 'selected' : '' }}>
                                    {{ $rak->kodeRak }}
                                </option>
                            @endforeach
                        </select>
                        @error('idRak')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Stok --}}
                    <div class="mb-3">
                        <label class="form-label">Stok <span class="text-danger">*</span></label>
                        <input type="number" name="stok_total" class="form-control @error('stok_total') is-invalid @enderror" 
                               value="{{ old('stok_total', $buku->stok_total) }}" min="0" required>
                        @error('stok_total')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- Stok Tersedia --}}
                     <div class="mb-3">
                        <label class="form-label">Stok Tersedia <span class="text-danger">*</span></label>
                        <input type="number" name="stok_tersedia" class="form-control @error('stok_tersedia') is-invalid @enderror" 
                               value="{{ old('stok_tersedia', $buku->stok_tersedia) }}" min="0" required>
                        @error('stok_tersedia')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    {{-- Tahun Terbit --}}
                    <div class="mb-3">
                        <label class="form-label">Tahun Terbit <span class="text-danger">*</span></label>
                        <input type="number" name="tahunTerbit" class="form-control @error('tahunTerbit') is-invalid @enderror" 
                               value="{{ old('tahunTerbit', $buku->tahunTerbit) }}" min="1900" max="{{ date('Y') }}" required>
                        @error('tahunTerbit')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" 
                                  rows="2">{{ old('deskripsi', $buku->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tombol --}}
                    <div class="d-flex gap-2">
                        <a href="{{ route('buku.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection