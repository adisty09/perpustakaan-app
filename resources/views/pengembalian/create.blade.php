@extends('main')

@section('title', 'Proses Pengembalian')

@section('content')
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-arrow-return-left me-2"></i>Form Pengembalian Buku</h5>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <strong>Anggota:</strong> {{ $peminjaman->anggota->nama }}<br>
                    <strong>ID Peminjaman:</strong> {{ $peminjaman->idPeminjaman }}<br>
                    <strong>Tanggal Pinjam:</strong> {{ \Carbon\Carbon::parse($peminjaman->tglPinjam)->format('d/m/Y') }}<br>
                    <strong>Jatuh Tempo:</strong> {{ \Carbon\Carbon::parse($peminjaman->tgl_jatuh_tempo)->format('d/m/Y') }}
                </div>
                
                <div class="alert {{ $keterlambatanHari > 0 ? 'alert-danger' : 'alert-success' }}">
                    <strong>Keterlambatan:</strong> {{ ceil($keterlambatanHari) }} hari<br>
                    <strong>Denda:</strong> Rp {{ number_format(ceil($keterlambatanHari) * 2000, 0, ',', '.') }}
                </div>
                
                <form action="{{ route('pengembalian.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="idPeminjaman" value="{{ $peminjaman->idPeminjaman }}">
                    <input type="hidden" name="idPengembalian" value="{{ $newId }}">
                    <input type="hidden" name="tglKembali_real" value="{{ date('Y-m-d') }}">
                    <input type="hidden" name="keterlambatanHari" value="{{ ceil($keterlambatanHari) }}">
                    <input type="hidden" name="dendaDibayar" value="{{ ceil($keterlambatanHari) * 2000 }}">
                    
                    <div class="mb-3">
                        <label class="form-label">Petugas Penerima</label>
                        <select name="idPustakawan" class="form-select" required>
                            <option value="">Pilih Petugas</option>
                            @foreach($pustakawans as $pustakawan)
                                <option value="{{ $pustakawan->idPustakawan }}">{{ $pustakawan->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <a href="{{ route('pengembalian.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Proses Pengembalian</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection