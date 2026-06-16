@extends('main')

@section('title', 'Pengembalian Buku')

@section('content')
<div class="card">
    <div class="card-header bg-white">
        <h5 class="mb-0"><i class="bi bi-arrow-return-left me-2"></i>Daftar Peminjaman Aktif</h5>
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
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($peminjamans as $pinjam)
                    <tr>
                        <td>{{ $pinjam->idPeminjaman }}</td>
                        <td>{{ $pinjam->anggota->nama ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($pinjam->tglPinjam)->format('d/m/Y') }}</td>
                        <td>
                            {{ \Carbon\Carbon::parse($pinjam->tgl_jatuh_tempo)->format('d/m/Y') }}
                            @if(\Carbon\Carbon::now()->gt($pinjam->tgl_jatuh_tempo))
                                <span class="badge bg-danger">Terlambat</span>
                            @endif
                        </td>
                        <td><span class="badge bg-warning">Dipinjam</span></td>
                        <td>
                            <a href="{{ route('pengembalian.create', $pinjam->idPeminjaman) }}" class="btn btn-success btn-sm">
                                <i class="bi bi-check-circle"></i> Proses Kembali
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Tidak ada peminjaman aktif</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $peminjamans->links() }}
        </div>
    </div>
</div>
@endsection