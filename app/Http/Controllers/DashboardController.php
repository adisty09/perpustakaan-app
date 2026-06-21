<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAnggota = Anggota::count();
        $totalBuku = Buku::sum('stok_total');
        $peminjamanAktif = Peminjaman::where('status_pinjam', 'Dipinjam')->count();
        
        // 1. Hitung denda dari buku yang SUDAH dikembalikan
        $dendaSelesai = Pengembalian::sum('dendaDibayar') ?? 0;

        // 2. Hitung denda berjalan dari buku yang MASIH DIPINJAM tapi terlambat
        $dendaPerHari = 1000; // Atur tarif denda per hari di sini (misal Rp 1.000)
        $peminjamanTerlambat = Peminjaman::where('status_pinjam', 'Dipinjam')
            ->where('tgl_jatuh_tempo', '<', Carbon::now())
            ->get();

        $dendaBerjalan = 0;
        foreach ($peminjamanTerlambat as $pinjam) {
            $tglJatuhTempo = Carbon::parse($pinjam->tgl_jatuh_tempo);
            $selisihHari = Carbon::now()->diffInDays($tglJatuhTempo);
            $dendaBerjalan += ($selisihHari * $dendaPerHari);
        }

        // Total denda gabungan (Selesai + Berjalan)
        $totalDenda = $dendaSelesai + $dendaBerjalan;

        $peminjamanTerbaru = Peminjaman::with(['anggota'])
            ->where('status_pinjam', 'Dipinjam')
            ->orderBy('tglPinjam', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'totalAnggota', 'totalBuku', 'peminjamanAktif', 'totalDenda', 'peminjamanTerbaru'
        ));
    }
}