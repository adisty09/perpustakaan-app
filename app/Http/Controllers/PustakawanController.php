<?php

namespace App\Http\Controllers;

use App\Models\Pustakawan;
use Illuminate\Http\Request;

class PustakawanController extends Controller
{
    public function index()
    {
        $pustakawans = Pustakawan::paginate(10);
        return view('pustakawan.index', compact('pustakawans'));
    }

    public function create()
    {
        $lastId = Pustakawan::max('idPustakawan');
        $newId = $lastId ? 'PW' . str_pad((intval(substr($lastId, 2)) + 1), 3, '0', STR_PAD_LEFT) : 'PW001';
        return view('pustakawan.create', compact('newId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idPustakawan' => 'required|unique:pustakawans|max:5',
            'nama' => 'required|max:50',
            'alamat' => 'nullable|max:100',
            'no_telp' => 'nullable|max:15',
            'jabatan' => 'required|max:30',
            'gaji_pokok' => 'required|numeric|min:0',
        ]);

        Pustakawan::create($request->all());
        return redirect()->route('pustakawan.index')->with('success', 'Pustakawan berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $pustakawan = Pustakawan::findOrFail($id);
        return view('pustakawan.show', compact('pustakawan'));
    }

    public function edit(string $id)
    {
        $pustakawan = Pustakawan::findOrFail($id);
        return view('pustakawan.edit', compact('pustakawan'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|max:50',
            'alamat' => 'nullable|max:100',
            'no_telp' => 'nullable|max:15',
            'jabatan' => 'required|max:30',
            'gaji_pokok' => 'required|numeric|min:0',
        ]);

        $pustakawan = Pustakawan::findOrFail($id);
        $pustakawan->update($request->all());
        return redirect()->route('pustakawan.index')->with('success', 'Pustakawan berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $pustakawan = Pustakawan::findOrFail($id);
        
        // Cek apakah pustakawan masih memiliki peminjaman
        if ($pustakawan->peminjamans()->count() > 0) {
            return redirect()->route('pustakawan.index')->with('error', 'Pustakawan tidak dapat dihapus karena masih memiliki transaksi peminjaman!');
        }
        
        $pustakawan->delete();
        return redirect()->route('pustakawan.index')->with('success', 'Pustakawan berhasil dihapus');
    }
}