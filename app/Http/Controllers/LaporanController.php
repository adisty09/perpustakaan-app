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
    
    // Denda per Anggota
    public function dendaPerAnggota()
    {
        $dendas = DB::select("
            SELECT a.idAnggota, a.nama, COUNT(p.idPeminjaman) as total_pinjam, 
                   COALESCE(SUM(pg.dendaDibayar), 0) as total_denda
            FROM anggotas a
            LEFT JOIN peminjamans p ON a.idAnggota = p.idAnggota
            LEFT JOIN pengembalians pg ON p.idPeminjaman = pg.idPeminjaman
            GROUP BY a.idAnggota, a.nama
            ORDER BY total_denda DESC
        ");
        
        return view('laporan.denda-per-anggota', compact('dendas'));
    }
    
    // Peminjaman Bulanan → view: laporan.bulanan
    public function peminjamanBulanan()
    {
        $peminjamanPerBulan = DB::select("
            SELECT DATE_FORMAT(tglPinjam, '%Y-%m') as bulan, COUNT(*) as total
            FROM peminjamans
            WHERE tglPinjam >= DATE_SUB(NOW(), INTERVAL 12 MONTH)
            GROUP BY DATE_FORMAT(tglPinjam, '%Y-%m')
            ORDER BY bulan ASC
        ");
        
        return view('laporan.bulanan', compact('peminjamanPerBulan'));
    }
}