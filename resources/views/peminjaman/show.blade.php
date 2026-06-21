@extends('main')

@section('title', 'Detail Peminjaman')

@section('content')
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                <h5 class="mb-0 fw-bold"><i class="bi bi-info-circle me-2 text-primary"></i>Detail Transaksi Peminjaman</h5>
                <span class="badge {{ $peminjaman->status_pinjam == 'Dipinjam' ? 'bg-warning text-dark' : 'bg-success' }} px-3 py-2">
                    {{ $peminjaman->status_pinjam }}
                </span>
            </div>
            <div class="card-body p-4">

                {{-- Data Anggota --}}
                <div class="mb-3">
                    <label class="form-label text-muted small mb-1 d-block">NAMA ANGGOTA</label>
                    <span class="fw-semibold text-dark fs-6">{{ $peminjaman->anggota->nama ?? '-' }}</span>
                </div>

                {{-- Data Petugas --}}
                <div class="mb-3">
                    <label class="form-label text-muted small mb-1 d-block">PETUGAS PUSTAKAWAN</label>
                    <span class="fw-semibold text-dark fs-6">{{ $peminjaman->pustakawan->nama ?? '-' }}</span>
                </div>

                <hr class="text-muted my-3 opacity-25">

                {{-- Informasi Waktu Transaksi --}}
                <div class="row mb-3">
                    <div class="col-6">
                        <label class="form-label text-muted small mb-1 d-block">TANGGAL PINJAM</label>
                        <span class="text-dark fw-semibold">
                            <i class="bi bi-calendar-check me-1 text-secondary"></i>
                            {{ \Carbon\Carbon::parse($peminjaman->tglPinjam)->format('d/m/Y') }}
                        </span>
                    </div>
                    <div class="col-6">
                        <label class="form-label text-muted small mb-1 d-block">JATUH TEMPO</label>
                        <span class="text-dark fw-semibold">
                            <i class="bi bi-calendar-x me-1 text-secondary"></i>
                            {{ \Carbon\Carbon::parse($peminjaman->tgl_jatuh_tempo)->format('d/m/Y') }}
                        </span>
                    </div>
                </div>

                <hr class="text-muted my-3 opacity-25">

                {{-- Logika & Notifikasi Keterlambatan Real-time --}}
                @php
                    $tglJatuhTempo = \Carbon\Carbon::parse($peminjaman->tgl_jatuh_tempo);
                    $hariIni = \Carbon\Carbon::now();
                    $dendaPerHari = 1000;
                    $terlambat = 0;
                    $totalDenda = 0;

                    if ($peminjaman->status_pinjam == 'Dipinjam' && $hariIni->gt($tglJatuhTempo)) {
                        $terlambat = $hariIni->diffInDays($tglJatuhTempo);
                        $totalDenda = $terlambat * $dendaPerHari;
                    }
                @endphp

                @if($totalDenda > 0)
                    <div class="alert alert-danger d-flex align-items-center mb-3" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
                        <div>
                            <strong>Transaksi Terlambat!</strong> Pengembalian melewati batas jatuh tempo sebanyak <strong>{{ $terlambat }} hari</strong>.
                        </div>
                    </div>

                    <div class="mb-3 bg-danger bg-opacity-10 p-3 rounded border border-danger border-opacity-25 mb-3">
                        <label class="form-label text-danger small mb-1 d-block fw-bold">TOTAL DENDA BERJALAN</label>
                        <span class="text-danger fw-bold fs-4">Rp {{ number_format($totalDenda, 0, ',', '.') }}</span>
                    </div>
                    <hr class="text-muted my-3 opacity-25">
                @endif

                {{-- Daftar Buku Yang Dipinjam --}}
                <div class="mb-4">
                    <label class="form-label text-muted small mb-2 d-block">BUKU YANG DIPINJAM</label>
                    <div class="list-group">
                        @foreach($peminjaman->detailPeminjamans as $detail)
                            <div class="list-group-item d-flex justify-content-between align-items-center bg-light border-0 mb-1 rounded py-2">
                                <span class="text-dark">
                                    <i class="bi bi-book me-2 text-primary"></i>
                                    {{ $detail->buku->judul ?? 'Buku Terhapus' }}
                                </span>
                                <span class="badge bg-white text-secondary border px-2 py-1 small">
                                    Status: {{ $detail->status_kembali }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Tombol Navigasi Kembali --}}
                <div class="d-flex gap-2 pt-2">
                    <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary w-100 py-2 fw-semibold">
                        <i class="bi bi-arrow-left me-1"></i>Kembali ke Data
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection