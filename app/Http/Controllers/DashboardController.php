<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAnggota = Anggota::count();
        $totalBuku = Buku::sum('stok_total');
        $peminjamanAktif = Peminjaman::where('status_pinjam', 'Dipinjam')->count();
        $totalDenda = Pengembalian::sum('dendaDibayar');
        
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