@extends('main')

@section('title', 'Edit Peminjaman')

@section('content')
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Edit Transaksi Peminjaman</h5>
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

                <form action="{{ route('peminjaman.update', $peminjaman->idPeminjaman) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- ID Peminjaman --}}
                    <div class="mb-3">
                        <label class="form-label">ID Peminjaman</label>
                        <input type="text" class="form-control bg-light" value="{{ $peminjaman->idPeminjaman }}" readonly>
                    </div>

                    {{-- Anggota --}}
                    <div class="mb-3">
                        <label class="form-label">Anggota <span class="text-danger">*</span></label>
                        <select name="idAnggota" class="form-select @error('idAnggota') is-invalid @enderror" required>
                            <option value="">Pilih Anggota</option>
                            @foreach($anggotas as $agt)
                                <option value="{{ $agt->idAnggota }}" 
                                    {{ old('idAnggota', $peminjaman->idAnggota) == $agt->idAnggota ? 'selected' : '' }}>
                                    {{ $agt->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('idAnggota')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Petugas Pustakawan --}}
                    <div class="mb-3">
                        <label class="form-label">Petugas Pustakawan <span class="text-danger">*</span></label>
                        <select name="idPustakawan" class="form-select @error('idPustakawan') is-invalid @enderror" required>
                            <option value="">Pilih Petugas</option>
                            @foreach($pustakawans as $pst)
                                <option value="{{ $pst->idPustakawan }}" 
                                    {{ old('idPustakawan', $peminjaman->idPustakawan) == $pst->idPustakawan ? 'selected' : '' }}>
                                    {{ $pst->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('idPustakawan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tanggal Pinjam --}}
                    <div class="mb-3">
                        <label class="form-label">Tanggal Pinjam <span class="text-danger">*</span></label>
                        <input type="date" name="tglPinjam" class="form-control @error('tglPinjam') is-invalid @enderror" 
                               value="{{ old('tglPinjam', \Carbon\Carbon::parse($peminjaman->tglPinjam)->format('Y-m-d')) }}" required>
                        @error('tglPinjam')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="d-flex gap-2 T-4">
                        <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Update Peminjaman</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection