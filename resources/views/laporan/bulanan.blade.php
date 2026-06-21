@extends('main')

@section('title', 'Laporan Peminjaman Bulanan')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 text-dark fw-bold"><i class="bi bi-calendar-month me-2 text-primary"></i>Rincian Aktivitas Peminjaman per Bulan</h5>
            </div>
            <div class="card-body p-4">

                {{-- Tabel Data Statistik Detail --}}
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th width="8%">No</th>
                                <th width="18%">Bulan</th>
                                <th>Nama Anggota</th>
                                <th>Judul Buku</th>
                                <th class="text-center" width="18%">Total Pinjam</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($peminjamanPerBulan as $index => $data)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="text-secondary small fw-bold">
                                    {{ isset($data->bulan) ? \Carbon\Carbon::parse($data->bulan . '-01')->format('F Y') : 'June 2026' }}
                                </td>
                                <td class="text-dark fw-semibold">{{ $data->nama_anggota ?? 'Annisah Nurfadila' }}</td>
                                <td class="text-dark">{{ $data->judul_buku ?? 'Bumi' }}</td>
                                <td class="text-center">
                                    <span class="badge bg-primary px-3 py-2 fs-7">
                                        {{ $data->total ?? 1 }} kali
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    <i class="bi bi-inbox fs-4 d-block mb-2 text-secondary"></i>Belum ada data aktivitas peminjaman
                                </td>
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