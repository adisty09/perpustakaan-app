@extends('main')

@section('title', 'Dashboard')

@section('content')
<div class="greeting-header mt-2 mb-4">
    <h2>Halo, {{ Auth::user()->name ?? 'Administrator' }}! 👋</h2>
    <p>Selamat datang di Sistem Informasi Perpustakaan Daerah Kota Palembang.</p>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card p-3 text-white" style="background: linear-gradient(135deg, #2a5298, #1e3c72);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <small class="opacity-75">TOTAL ANGGOTA</small>
                    <h2 class="mb-0 fw-bold">{{ $totalAnggota ?? 0 }}</h2>
                </div>
                <i class="bi bi-people fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 text-white" style="background: linear-gradient(135deg, #10b981, #059669);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <small class="opacity-75">TOTAL BUKU</small>
                    <h2 class="mb-0 fw-bold">{{ $totalBuku ?? 0 }}</h2>
                </div>
                <i class="bi bi-book fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 text-white" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <small class="opacity-75">PEMINJAMAN AKTIF</small>
                    <h2 class="mb-0 fw-bold">{{ $peminjamanAktif ?? 0 }}</h2>
                </div>
                <i class="bi bi-hand-index-thumb fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 text-white" style="background: linear-gradient(135deg, #ef4444, #dc2626);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <small class="opacity-75">TOTAL DENDA</small>
                    <h2 class="mb-0 fw-bold">Rp {{ number_format($totalDenda ?? 0, 0, ',', '.') }}</h2>
                </div>
                <i class="bi bi-cash-stack fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-clock-history me-2"></i>Peminjaman Terbaru</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID Peminjaman</th>
                                <th>Anggota</th>
                                <th>Tgl Pinjam</th>
                                <th>Jatuh Tempo</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($peminjamanTerbaru ?? [] as $pinjam)
                            <tr>
                                <td>{{ $pinjam->idPeminjaman }}</td>
                                <td>{{ $pinjam->anggota->nama ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($pinjam->tglPinjam)->format('d/m/Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($pinjam->tgl_jatuh_tempo)->format('d/m/Y') }}</td>
                                <td>
                                    <span class="badge bg-warning">Dipinjam</span>
                                    @if(\Carbon\Carbon::now()->gt($pinjam->tgl_jatuh_tempo))
                                        <span class="badge bg-danger">Terlambat</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Belum ada data peminjaman</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
    <p>Sistem Informasi Perpustakaan Digital</p>
@endsection