<?php

namespace App\Http\Controllers;

use App\Models\DetailPeminjaman;
use App\Models\Peminjaman;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailPeminjamanController extends Controller
{
    public function index()
    {
        $items = DetailPeminjaman::with(['peminjaman', 'buku'])->paginate(10);
        return view('detail-peminjaman.index', compact('items'));
    }

    public function create()
    {
        $peminjamans = Peminjaman::where('status_pinjam', 'Dipinjam')->get();
        $bukus = Buku::where('stok_tersedia', '>', 0)->get();
        return view('detail-peminjaman.create', compact('peminjamans', 'bukus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idPeminjaman' => 'required|exists:peminjamans,idPeminjaman',
            'idBuku' => 'required|exists:bukus,idBuku',
            'status_kembali' => 'required|in:Belum,Sudah',
        ]);

        DB::beginTransaction();
        try {
            $detail = DetailPeminjaman::create($request->all());
            
            if ($request->status_kembali === 'Sudah') {
                $buku = Buku::find($request->idBuku);
                $buku->decrement('stok_tersedia');
            }
            
            DB::commit();
            return redirect()->route('detail-peminjaman.index')->with('success', 'Detail peminjaman berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Gagal menambahkan detail peminjaman');
        }
    }

    public function show(string $id)
    {
        $detail = DetailPeminjaman::with(['peminjaman', 'buku'])->findOrFail($id);
        return view('detail-peminjaman.show', compact('detail'));
    }

    public function edit(string $id)
    {
        $detail = DetailPeminjaman::findOrFail($id);
        $peminjamans = Peminjaman::all();
        $bukus = Buku::all();
        return view('detail-peminjaman.edit', compact('detail', 'peminjamans', 'bukus'));
    }

    public function update(Request $request, string $id)
    {
        $detail = DetailPeminjaman::findOrFail($id);
        
        $request->validate([
            'status_kembali' => 'required|in:Belum,Sudah',
        ]);
        
        $oldStatus = $detail->status_kembali;
        $newStatus = $request->status_kembali;
        
        DB::beginTransaction();
        try {
            $detail->update($request->only('status_kembali'));
            
            if ($oldStatus === 'Belum' && $newStatus === 'Sudah') {
                $detail->buku->decrement('stok_tersedia');
            } elseif ($oldStatus === 'Sudah' && $newStatus === 'Belum') {
                $detail->buku->increment('stok_tersedia');
            }
            
            DB::commit();
            return redirect()->route('detail-peminjaman.index')->with('success', 'Detail peminjaman berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Gagal memperbarui detail peminjaman');
        }
    }

    public function destroy(string $id)
    {
        $detail = DetailPeminjaman::findOrFail($id);
        
        DB::beginTransaction();
        try {
            if ($detail->status_kembali === 'Sudah') {
                $detail->buku->increment('stok_tersedia');
            }
            $detail->delete();
            DB::commit();
            
            return redirect()->route('detail-peminjaman.index')->with('success', 'Detail peminjaman berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Gagal menghapus detail peminjaman');
        }
    }
}