<?php

namespace App\Http\Controllers;

use App\Models\RakBuku;
use Illuminate\Http\Request;

class RakBukuController extends Controller
{
    public function index()
    {
        $rakBukus = RakBuku::paginate(10);
        return view('rak-buku.index', compact('rakBukus'));
    }

    public function create()
    {
        $lastId = RakBuku::max('idRak');
        $newId = $lastId ? 'R' . str_pad((intval(substr($lastId, 1)) + 1), 3, '0', STR_PAD_LEFT) : 'R001';
        return view('rak-buku.create', compact('newId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idRak' => 'required|unique:rak_bukus|max:5',
            'kodeRak' => 'required|max:30',
            'lokasi' => 'nullable|max:100',
            'lantai' => 'required|integer',
        ]);

        RakBuku::create($request->all());
        return redirect()->route('rak-buku.index')->with('success', 'Rak Buku berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $rakBuku = RakBuku::findOrFail($id);
        return view('rak-buku.show', compact('rakBuku'));
    }

    public function edit(string $id)
    {
        $rakBuku = RakBuku::findOrFail($id);
        return view('rak-buku.edit', compact('rakBuku'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'kodeRak' => 'required|max:30',
            'lokasi' => 'nullable|max:100',
            'lantai' => 'required|integer',
        ]);

        $rakBuku = RakBuku::findOrFail($id);
        $rakBuku->update($request->all());
        return redirect()->route('rak-buku.index')->with('success', 'Rak Buku berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $rakBuku = RakBuku::findOrFail($id);
        
        // Cek apakah rak buku masih digunakan
        if ($rakBuku->bukus()->count() > 0) {
            return redirect()->route('rak-buku.index')->with('error', 'Rak Buku tidak dapat dihapus karena masih memiliki buku!');
        }
        
        $rakBuku->delete();
        return redirect()->route('rak-buku.index')->with('success', 'Rak Buku berhasil dihapus');
    }
}