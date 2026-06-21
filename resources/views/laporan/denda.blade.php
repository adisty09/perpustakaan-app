@extends('main')

@section('title', 'Laporan Denda per Anggota')

@section('content')
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 text-dark"><i class="bi bi-person-exclamation me-2 text-primary"></i>Daftar Denda Anggota</h5>
            </div>
            <div class="card-body p-4">

                {{-- Tabel Daftar Anggota Terkena Denda --}}
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th width="10%">No</th>
                                <th width="20%">ID Pinjam</th>
                                <th>Nama Anggota</th>
                                <th class="text-center" width="20%">Status</th>
                                <th width="25%" class="text-end">Total Denda</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php 
                                $no = 1; 
                                $grandTotalDenda = 0; 
                            @endphp
                            
                            @forelse($dendas as $denda)
                                @php 
                                    $grandTotalDenda += ($denda->total_denda ?? 0); 
                                    $statusBayar = $denda->status_bayar ?? 'Belum Bayar'; 
                                @endphp
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td><span class="badge bg-light text-dark border">{{ $denda->idPeminjaman }}</span></td>
                                    <td class="text-dark fw-semibold">{{ $denda->nama ?? '-' }}</td>
                                    <td class="text-center">
                                        @if($statusBayar == 'Lunas')
                                            <span class="badge bg-success px-2 py-1">Lunas</span>
                                        @else
                                            <span class="badge bg-danger px-2 py-1">Belum Bayar</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <span class="badge bg-primary px-2 py-1">
                                            Rp {{ number_format($denda->total_denda ?? 0, 0, ',', '.') }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-3">Tidak ada data denda anggota</td>
                                </tr>
                            @endforelse
                        </tbody>
                        
                        {{-- Baris Jumlah Total Denda Keseluruhan --}}
                        @if($grandTotalDenda > 0)
                        <tfoot class="table-light border-top-2">
                            <tr>
                                <td colspan="4" class="fw-bold text-dark text-uppercase small py-3">Total Akumulasi Denda</td>
                                <td class="text-end fw-bold text-primary fs-6 py-3">
                                    Rp {{ number_format($grandTotalDenda, 0, ',', '.') }}
                                </td>
                            </tr>
                        </tfoot>
                        @endif
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection