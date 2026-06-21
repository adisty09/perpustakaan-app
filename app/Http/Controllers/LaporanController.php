<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    // Buku Terpopuler → view: laporan.index
    public function bukuTerpopuler()
    {
        $bukus = DB::select("
            SELECT b.idBuku, b.judul, COUNT(dp.idBuku) as total_dipinjam
            FROM detail_peminjamans dp
            JOIN bukus b ON dp.idBuku = b.idBuku
            GROUP BY b.idBuku, b.judul
            ORDER BY total_dipinjam DESC
            LIMIT 10
        ");

        return view('laporan.index', compact('bukus'));
    }

   // Denda per Anggota -> view: laporan.denda
    public function dendaPerAnggota()
    {
        // 1. Ambil data denda dari transaksi yang SUDAH dikembalikan (Lunas)
        $dendaSelesai = DB::table('pengembalians as pg')
            ->join('peminjamans as p', 'pg.idPeminjaman', '=', 'p.idPeminjaman')
            ->join('anggotas as a', 'p.idAnggota', '=', 'a.idAnggota')
            ->select(
                'p.idPeminjaman',
                'a.nama',
                'pg.dendaDibayar as total_denda',
                DB::raw("'Lunas' as status_bayar")
            )
            ->where('pg.dendaDibayar', '>', 0)
            ->get();

        // 2. Ambil transaksi yang MASIH DIPINJAM dan sudah melewati jatuh tempo (Denda Berjalan)
        $peminjamanTerlambat = DB::table('peminjamans as p')
            ->join('anggotas as a', 'p.idAnggota', '=', 'a.idAnggota')
            ->select(
                'p.idPeminjaman',
                'a.nama',
                'p.tgl_jatuh_tempo',
                DB::raw("'Belum Bayar' as status_bayar")
            )
            ->where('p.status_pinjam', 'Dipinjam')
            ->where('p.tgl_jatuh_tempo', '<', \Carbon\Carbon::now()->startOfDay())
            ->get();

        $dendaPerHari = 2000; // Tarif Rp 2.000 per hari
        $dendaBerjalan = [];

        // 3. Hitung hari keterlambatan secara presisi untuk denda yang masih berjalan
        foreach ($peminjamanTerlambat as $pinjam) {
            $tglJatuhTempo = \Carbon\Carbon::parse($pinjam->tgl_jatuh_tempo)->startOfDay();
            $hariIni = \Carbon\Carbon::now()->startOfDay();
            
            // Selisih hari bulat (15 Juni ke 21 Juni = 6 Hari)
            $selisihHari = $hariIni->diffInDays($tglJatuhTempo);
            $totalDenda = $selisihHari * $dendaPerHari;

            if ($totalDenda > 0) {
                $dendaBerjalan[] = (object)[
                    'idPeminjaman' => $pinjam->idPeminjaman,
                    'nama' => $pinjam->nama,
                    'total_denda' => $totalDenda,
                    'status_bayar' => 'Belum Bayar'
                ];
            }
        }

        // 4. Gabungkan data denda Lunas & Belum Bayar, lalu urutkan dari transaksi terbaru
        $dendas = collect($dendaSelesai)->merge($dendaBerjalan)->sortByDesc('idPeminjaman')->values();

        return view('laporan.denda', compact('dendas'));
    }
    // Peminjaman Bulanan → view: laporan.bulanan
    public function peminjamanBulanan()
    {
        // Query untuk mengambil data bulan, nama anggota, judul buku, dan total pinjam
        $peminjamanPerBulan = DB::table('detail_peminjamans')
            ->join('peminjamans', 'detail_peminjamans.idPeminjaman', '=', 'peminjamans.idPeminjaman')
            ->join('anggotas', 'peminjamans.idAnggota', '=', 'anggotas.idAnggota')
            ->join('bukus', 'detail_peminjamans.idBuku', '=', 'bukus.idBuku')
            ->select(
                DB::raw("DATE_FORMAT(peminjamans.tglPinjam, '%Y-%m') as bulan"),
                'anggotas.nama as nama_anggota',
                'bukus.judul as judul_buku',
                DB::raw('COUNT(detail_peminjamans.idBuku) as total')
            )
            ->groupBy('bulan', 'anggotas.idAnggota', 'bukus.idBuku', 'anggotas.nama', 'bukus.judul')
            ->orderBy('bulan', 'asc')
            ->get();

        return view('laporan.bulanan', compact('peminjamanPerBulan'));
    }
}
