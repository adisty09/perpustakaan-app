<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Penerbit;
use App\Models\JenisBuku;
use App\Models\Pengarang;
use App\Models\RakBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::with(['penerbit', 'jenisBuku'])->paginate(10);
        return view('buku.index', compact('bukus'));
    }

    public function create()
    {
        $penerbits = Penerbit::all();
        $jenisBukus = JenisBuku::all();
        $pengarangs = Pengarang::all();
        $rakBukus = RakBuku::all();

        $lastId = Buku::max('idBuku');
        $newId = $lastId ? 'BK' . str_pad((intval(substr($lastId, 2)) + 1), 3, '0', STR_PAD_LEFT) : 'BK001';

        return view('buku.create', compact('penerbits', 'jenisBukus', 'pengarangs', 'rakBukus', 'newId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idBuku' => 'required|unique:bukus|max:5',
            'judul' => 'required|max:100',
            'isbn' => 'nullable|max:20',
            'tahunTerbit' => 'required|integer|min:1900|max:' . date('Y'),
            'stok_total' => 'required|integer|min:0',
            'stok_tersedia' => 'required|integer|min:0',
            'idPenerbit' => 'required|exists:penerbits,idPenerbit',
            'idJenis' => 'required|exists:jenis_bukus,idJenis',
        ]);

        DB::beginTransaction();
        try {
            $buku = Buku::create($request->all());

            if ($request->has('pengarangs')) {
                $buku->pengarangs()->attach($request->pengarangs);
            }

            if ($request->has('rakBukus')) {
                foreach ($request->rakBukus as $idRak => $jumlah) {
                    if ($jumlah > 0) {
                        $buku->rakBukus()->attach($idRak, ['jumlah' => $jumlah]);
                    }
                }
            }

            DB::commit();
            return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Gagal menambahkan buku');
        }
    }

    public function show($id)
    {
        $buku = Buku::with(['penerbit', 'jenisBuku', 'pengarangs', 'rakBukus'])->findOrFail($id);
        return view('buku.show', compact('buku'));
    }

    public function edit($id)
    {
        $buku = Buku::with(['pengarangs', 'rakBukus'])->findOrFail($id);
        $penerbit = Penerbit::all();
        $jenisBuku = JenisBuku::all();
        $pengarang = Pengarang::all();
        $rakBuku = RakBuku::all();

        return view('buku.edit', compact('buku', 'penerbit', 'jenisBuku', 'pengarang', 'rakBuku'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|max:100',
            'isbn' => 'nullable|max:20',
            'tahunTerbit' => 'required|integer|min:1900|max:' . date('Y'),
            'stok_total' => 'required|integer|min:0',
            'stok_tersedia' => 'required|integer|min:0',
            'idPenerbit' => 'required|exists:penerbits,idPenerbit',
            'idJenis' => 'required|exists:jenis_bukus,idJenis',
        ]);

        $buku = Buku::findOrFail($id);
        $buku->update($request->all());

        if ($request->has('pengarangs')) {
            $buku->pengarangs()->sync($request->pengarangs);
        }

        return redirect()->route('buku.index')->with('success', 'Buku berhasil diperbarui');
    }

    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);

        if ($buku->detailPeminjamans()->count() > 0) {
            return redirect()->route('buku.index')->with('error', 'Buku tidak dapat dihapus karena sudah pernah dipinjam!');
        }

        $buku->pengarangs()->detach();
        $buku->rakBukus()->detach();
        $buku->delete();
        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus');
    }

    public function bukuTersedia()
    {
        $bukus = Buku::where('stok_tersedia', '>', 0)->select('idBuku', 'judul', 'stok_tersedia')->get();
        return response()->json($bukus);
    }
}
