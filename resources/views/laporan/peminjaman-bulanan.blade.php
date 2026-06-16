@extends('main')

@section('title', 'Laporan Peminjaman Bulanan')

@section('content')
<div class="card">
    <div class="card-header bg-white">
        <h5 class="mb-0"><i class="bi bi-calendar-month me-2"></i>Statistik Peminjaman per Bulan</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Bulan</th>
                        <th>Total Peminjaman</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($peminjamanPerBulan as $index => $data)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($data->bulan . '-01')->format('F Y') }}</td>
                        <td>
                            <span class="badge bg-primary">{{ $data->total }} kali</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted">Belum ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('footer')
    <p>Laporan Peminjaman Bulanan - Dinas Kearsipan dan Perpustakaan Kota Palembang</p>
@endsection