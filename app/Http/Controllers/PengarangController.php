<?php

namespace App\Http\Controllers;

use App\Models\Pengarang;
use Illuminate\Http\Request;

class PengarangController extends Controller
{
    public function index()
    {
        $pengarangs = Pengarang::paginate(10);
        return view('pengarang.index', compact('pengarangs'));
    }

    public function create()
    {
        $lastId = Pengarang::max('idPengarang');
        $newId = $lastId ? 'PG' . str_pad((intval(substr($lastId, 2)) + 1), 3, '0', STR_PAD_LEFT) : 'PG001';
        return view('pengarang.create', compact('newId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idPengarang' => 'required|unique:pengarangs|max:5',
            'nama' => 'required|max:50',
            'negara' => 'nullable|max:30',
            'tgl_lahir' => 'nullable|date',
        ]);

        Pengarang::create($request->all());
        return redirect()->route('pengarang.index')->with('success', 'Pengarang berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $pengarang = Pengarang::findOrFail($id);
        return view('pengarang.show', compact('pengarang'));
    }

    public function edit(string $id)
    {
        $pengarang = Pengarang::findOrFail($id);
        return view('pengarang.edit', compact('pengarang'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|max:50',
            'negara' => 'nullable|max:30',
            'tgl_lahir' => 'nullable|date',
        ]);

        $pengarang = Pengarang::findOrFail($id);
        $pengarang->update($request->all());
        return redirect()->route('pengarang.index')->with('success', 'Pengarang berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $pengarang = Pengarang::findOrFail($id);
        
        // Cek apakah pengarang masih digunakan di buku
        if ($pengarang->bukus()->count() > 0) {
            return redirect()->route('pengarang.index')->with('error', 'Pengarang tidak dapat dihapus karena masih memiliki buku!');
        }
        
        $pengarang->delete();
        return redirect()->route('pengarang.index')->with('success', 'Pengarang berhasil dihapus');
    }
}