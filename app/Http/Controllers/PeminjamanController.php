<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\DetailPeminjaman;
use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Pustakawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with(['anggota', 'pustakawan'])
            ->orderBy('tglPinjam', 'desc')
            ->paginate(10);
        return view('peminjaman.index', compact('peminjamans'));
    }

    public function create()
    {
        $anggotas = Anggota::where('status', 'Aktif')->orderBy('nama')->get();
        $pustakawans = Pustakawan::orderBy('nama')->get();
        $bukus = Buku::where('stok_tersedia', '>', 0)->orderBy('judul')->get();
        
        $lastId = Peminjaman::max('idPeminjaman');
        $newId = $lastId ? 'PM' . str_pad((intval(substr($lastId, 2)) + 1), 3, '0', STR_PAD_LEFT) : 'PM001';
        
        return view('peminjaman.create', compact('anggotas', 'pustakawans', 'bukus', 'newId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idPeminjaman' => 'required|unique:peminjamans',
            'idAnggota' => 'required|exists:anggotas,idAnggota',
            'idPustakawan' => 'required|exists:pustakawans,idPustakawan',
            'tgl_pinjam' => 'nullable|date', // Validasi input tanggal opsional dari form
            'bukus' => 'required|array|min:1',
            'bukus.*' => 'exists:bukus,idBuku'
        ]);

        DB::beginTransaction();
        try {
            $lamaPinjam = 7;
            // Mengambil nilai dari input 'tgl_pinjam' dari form, jika kosong menggunakan waktu sekarang
            $tglPinjam = Carbon::parse($request->input('tgl_pinjam', Carbon::now()));
            $tglJatuhTempo = $tglPinjam->copy()->addDays($lamaPinjam);
            
            $peminjaman = Peminjaman::create([
                'idPeminjaman' => $request->idPeminjaman,
                'tglPinjam' => $tglPinjam,
                'lamaPinjam' => $lamaPinjam,
                'tgl_jatuh_tempo' => $tglJatuhTempo,
                'status_pinjam' => 'Dipinjam',
                'idAnggota' => $request->idAnggota,
                'idPustakawan' => $request->idPustakawan
            ]);
            
            foreach ($request->bukus as $idBuku) {
                DetailPeminjaman::create([
                    'idPeminjaman' => $peminjaman->idPeminjaman,
                    'idBuku' => $idBuku,
                    'status_kembali' => 'Belum'
                ]);
                
                Buku::where('idBuku', $idBuku)->decrement('stok_tersedia');
            }
            
            DB::commit();
            return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil dicatat');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Gagal mencatat peminjaman');
        }
    }

    public function show($id)
    {
        $peminjaman = Peminjaman::with(['anggota', 'pustakawan', 'detailPeminjamans.buku'])
            ->findOrFail($id);
        return view('peminjaman.show', compact('peminjaman'));
    }

    public function edit($id)
    {
        // Mengambil data peminjaman beserta relasi detail buku, anggota, dan pustakawan
        $peminjaman = Peminjaman::with(['anggota', 'pustakawan', 'detailPeminjamans.buku'])->findOrFail($id);
        
        // Mengambil data pendukung untuk pilihan dropdown di form edit
        $anggotas = Anggota::where('status', 'Aktif')->orderBy('nama')->get();
        $pustakawans = Pustakawan::orderBy('nama')->get();
        $bukus = Buku::orderBy('judul')->get();

        return view('peminjaman.edit', compact('peminjaman', 'anggotas', 'pustakawans', 'bukus'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'idAnggota' => 'required|exists:anggotas,idAnggota',
            'idPustakawan' => 'required|exists:pustakawans,idPustakawan',
            'tglPinjam' => 'required|date',
        ]);

        $peminjaman = Peminjaman::findOrFail($id);

        DB::beginTransaction();
        try {
            $lamaPinjam = 7;
            $tglPinjam = Carbon::parse($request->tglPinjam);
            $tglJatuhTempo = $tglPinjam->copy()->addDays($lamaPinjam);

            // Memperbarui data utama transaksi peminjaman
            $peminjaman->update([
                'tglPinjam' => $tglPinjam,
                'tgl_jatuh_tempo' => $tglJatuhTempo,
                'idAnggota' => $request->idAnggota,
                'idPustakawan' => $request->idPustakawan
            ]);

            DB::commit();
            return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Gagal memperbarui data peminjaman');
        }
    }

    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        
        if ($peminjaman->status_pinjam != 'Dipinjam') {
            return redirect()->route('peminjaman.index')->with('error', 'Tidak dapat menghapus peminjaman yang sudah selesai!');
        }
        
        DB::beginTransaction();
        try {
            foreach ($peminjaman->detailPeminjamans as $detail) {
                Buku::where('idBuku', $detail->idBuku)->increment('stok_tersedia');
            }
            
            $peminjaman->detailPeminjamans()->delete();
            $peminjaman->delete();
            
            DB::commit();
            return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil dibatalkan');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Gagal membatalkan peminjaman');
        }
    }
}