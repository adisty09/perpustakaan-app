<?php

namespace App\Http\Controllers;

use App\Models\JenisBuku;
use Illuminate\Http\Request;

class JenisBukuController extends Controller
{
    public function index()
    {
        $jenisBukus = JenisBuku::paginate(10);
        return view('jenis-buku.index', compact('jenisBukus'));
    }

    public function create()
    {
        $lastId = JenisBuku::max('idJenis');
        $newId = $lastId ? 'J' . str_pad((intval(substr($lastId, 1)) + 1), 3, '0', STR_PAD_LEFT) : 'J001';
        return view('jenis-buku.create', compact('newId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idJenis' => 'required|unique:jenis_bukus|max:5',
            'namaJenis' => 'required|max:30',
            'deskripsi' => 'nullable|max:100',
        ]);

        JenisBuku::create($request->all());
        return redirect()->route('jenis-buku.index')->with('success', 'Jenis Buku berhasil ditambahkan');
    }

    public function edit($id)
    {
        $jenisBuku = JenisBuku::findOrFail($id);
        return view('jenis-buku.edit', compact('jenisBuku'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'namaJenis' => 'required|max:30',
            'deskripsi' => 'nullable|max:100',
        ]);

        $jenisBuku = JenisBuku::findOrFail($id);
        $jenisBuku->update($request->all());
        return redirect()->route('jenis-buku.index')->with('success', 'Jenis Buku berhasil diperbarui');
    }

    public function destroy($id)
    {
        $jenisBuku = JenisBuku::findOrFail($id);
        
        if ($jenisBuku->bukus()->count() > 0) {
            return redirect()->route('jenis-buku.index')->with('error', 'Jenis Buku tidak dapat dihapus karena masih memiliki buku!');
        }
        
        $jenisBuku->delete();
        return redirect()->route('jenis-buku.index')->with('success', 'Jenis Buku berhasil dihapus');
    }
}