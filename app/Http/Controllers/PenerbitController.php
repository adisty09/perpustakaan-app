<?php

namespace App\Http\Controllers;

use App\Models\Penerbit;
use Illuminate\Http\Request;

class PenerbitController extends Controller
{
    public function index()
    {
        $penerbits = Penerbit::paginate(10);
        return view('penerbit.index', compact('penerbits'));
    }

    public function create()
    {
        $lastId = Penerbit::max('idPenerbit');
        $newId = $lastId ? 'P' . str_pad((intval(substr($lastId, 1)) + 1), 3, '0', STR_PAD_LEFT) : 'P001';
        return view('penerbit.create', compact('newId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idPenerbit' => 'required|unique:penerbits|max:5',
            'nama' => 'required|max:50',
            'alamat' => 'nullable|max:100',
            'no_telp' => 'nullable|max:15',
            'email' => 'nullable|email|max:50',
        ]);

        Penerbit::create($request->all());
        return redirect()->route('penerbit.index')->with('success', 'Penerbit berhasil ditambahkan');
    }

    public function edit($id)
    {
        $penerbit = Penerbit::findOrFail($id);
        return view('penerbit.edit', compact('penerbit'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|max:50',
            'alamat' => 'nullable|max:100',
            'no_telp' => 'nullable|max:15',
            'email' => 'nullable|email|max:50',
        ]);

        $penerbit = Penerbit::findOrFail($id);
        $penerbit->update($request->all());
        return redirect()->route('penerbit.index')->with('success', 'Penerbit berhasil diperbarui');
    }

    public function destroy($id)
    {
        $penerbit = Penerbit::findOrFail($id);
        
        if ($penerbit->bukus()->count() > 0) {
            return redirect()->route('penerbit.index')->with('error', 'Penerbit tidak dapat dihapus karena masih memiliki buku!');
        }
        
        $penerbit->delete();
        return redirect()->route('penerbit.index')->with('success', 'Penerbit berhasil dihapus');
    }
}