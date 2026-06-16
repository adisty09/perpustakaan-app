@extends('main')

@section('title', 'Data Peminjaman')

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-hand-index-thumb me-2"></i>Data Peminjaman</h5>
        <a href="{{ route('peminjaman.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle me-1"></i> Peminjaman Baru
        </a>
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
                        <th>Petugas</th>
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
                            @if($pinjam->status_pinjam == 'Dipinjam' && \Carbon\Carbon::now()->gt($pinjam->tgl_jatuh_tempo))
                                <span class="badge bg-danger">Terlambat</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge {{ $pinjam->status_pinjam == 'Dipinjam' ? 'bg-warning' : 'bg-success' }}">
                                {{ $pinjam->status_pinjam }}
                            </span>
                        </td>
                        <td>{{ $pinjam->pustakawan->nama ?? '-' }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('peminjaman.show', $pinjam->idPeminjaman) }}" class="btn btn-outline-info btn-sm">
                                    <i class="bi bi-eye"></i>
                                </a>
                                @if($pinjam->status_pinjam == 'Dipinjam')
                                    <a href="{{ route('pengembalian.create', $pinjam->idPeminjaman) }}" class="btn btn-outline-success btn-sm">
                                        <i class="bi bi-arrow-return-left"></i>
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Belum ada data peminjaman</td>
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