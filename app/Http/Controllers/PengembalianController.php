<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Buku;
use App\Models\Pustakawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PengembalianController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with(['anggota'])
            ->where('status_pinjam', 'Dipinjam')
            ->orderBy('tgl_jatuh_tempo')
            ->paginate(10);
        
        return view('pengembalian.index', compact('peminjamans'));
    }

    public function create($idPeminjaman)
    {
        $peminjaman = Peminjaman::with(['anggota', 'detailPeminjamans.buku'])
            ->findOrFail($idPeminjaman);
        
        if ($peminjaman->status_pinjam != 'Dipinjam') {
            return redirect()->route('pengembalian.index')->with('error', 'Peminjaman ini sudah dikembalikan!');
        }
        
        $pustakawans = Pustakawan::orderBy('nama')->get();
        
        $tglJatuhTempo = Carbon::parse($peminjaman->tgl_jatuh_tempo);
        $today = Carbon::now();
        $keterlambatanHari = $today->gt($tglJatuhTempo) ? $tglJatuhTempo->diffInDays($today) : 0;
        $denda = $keterlambatanHari * 2000;
        
        $lastId = Pengembalian::max('idPengembalian');
        $newId = $lastId ? 'KB' . str_pad((intval(substr($lastId, 2)) + 1), 3, '0', STR_PAD_LEFT) : 'KB001';
        
        return view('pengembalian.create', compact('peminjaman', 'pustakawans', 'keterlambatanHari', 'denda', 'newId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idPengembalian' => 'required|unique:pengembalians',
            'idPeminjaman' => 'required|exists:peminjamans,idPeminjaman',
            'idPustakawan' => 'required|exists:pustakawans,idPustakawan',
            'tglKembali_real' => 'required|date',
            'keterlambatanHari' => 'required|integer',
            'dendaDibayar' => 'required|numeric'
        ]);

        DB::beginTransaction();
        try {
            Pengembalian::create([
                'idPengembalian' => $request->idPengembalian,
                'tglKembali_real' => $request->tglKembali_real,
                'keterlambatanHari' => $request->keterlambatanHari,
                'dendaDibayar' => $request->dendaDibayar,
                'idPeminjaman' => $request->idPeminjaman,
                'idPustakawan' => $request->idPustakawan
            ]);
            
            $peminjaman = Peminjaman::find($request->idPeminjaman);
            $peminjaman->update(['status_pinjam' => 'Kembali']);
            
            foreach ($peminjaman->detailPeminjamans as $detail) {
                $detail->update(['status_kembali' => 'Sudah']);
                Buku::where('idBuku', $detail->idBuku)->increment('stok_tersedia');
            }
            
            DB::commit();
            return redirect()->route('pengembalian.index')->with('success', 'Pengembalian berhasil diproses');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Gagal memproses pengembalian');
        }
    }
}