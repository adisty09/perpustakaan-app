@extends('main')

@section('title', 'Buku Terpopuler')

@section('content')
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 text-dark"><i class="bi bi-bar-chart-line me-2"></i>Buku Paling Sering Dipinjam</h5>
                </div>
                <div class="card-body p-4">

                    {{-- Komponen Grafik Muncul --}}
                    <div class="mb-4" style="position: relative; height: 220px; width: 100%">
                        <canvas id="bukuChart"></canvas>
                    </div>

                    <hr class="text-muted my-4 opacity-25">

                    {{-- Tabel Data Asli Anda --}}
                    <div class="table-responsive">
                        <table id="tabelBukuPopuler" class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th width="15%">No</th>
                                    <th>ID Buku</th>
                                    <th>Judul Buku</th>
                                    <th width="30%">Total Dipinjam</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Menggunakan variabel cadangan fleksibel jika nama aslinya bukan $bukuTerpopuler --}}
                                @php
                                    $dataLoop = $bukuTerpopuler ?? ($bukus ?? ($bukuPopuler ?? []));
                                    $no = 1;
                                @endphp

                                @foreach ($dataLoop as $buku)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $buku->idBuku ?? ($buku->id_buku ?? '') }}</td>
                                        <td class="judul-buku-kelas text-dark fw-semibold">
                                            {{ $buku->judul ?? ($buku->judul_buku ?? '') }}</td>
                                        <td>
                                            <span class="badge bg-primary px-2 py-1 angka-total-kelas"
                                                data-jumlah="{{ $buku->total_dipinjam ?? ($buku->total ?? 0) }}">
                                                {{ $buku->total_dipinjam ?? ($buku->total ?? 0) }} kali
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        {{-- Load Library Chart.js via CDN --}}
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const labelBuku = [];
                const dataJumlah = [];

                // Membaca langsung dari element tabel
                const barisJudul = document.querySelectorAll('.judul-buku-kelas');
                const barisTotal = document.querySelectorAll('.angka-total-kelas');

                barisJudul.forEach((el, index) => {
                    labelBuku.push(el.innerText.trim());
                    dataJumlah.push(parseInt(barisTotal[index].getAttribute('data-jumlah')) || 0);
                });

                // Menggambar grafik
                const ctx = document.getElementById('bukuChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labelBuku,
                        datasets: [{
                            label: 'Total Dipinjam',
                            data: dataJumlah,
                            backgroundColor: '#0d6efd',
                            borderWidth: 0,
                            borderRadius: 4,
                            barThickness: 25
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1,
                                    font: {
                                        size: 12,
                                        family: 'system-ui, -apple-system, sans-serif'
                                    }
                                },
                                grid: {
                                    color: 'rgba(0, 0, 0, 0.04)'
                                }
                            },
                            x: {
                                ticks: {
                                    font: {
                                        size: 12,
                                        family: 'system-ui, -apple-system, sans-serif'
                                    }
                                },
                                grid: {
                                    display: false
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });
            });
        </script>
    @endpush
@endsection
