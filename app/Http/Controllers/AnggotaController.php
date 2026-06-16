<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggotas = Anggota::orderBy('nama')->paginate(10);
        return view('anggota.index', compact('anggotas'));
    }

    public function create()
    {
        // Generate ID Anggota otomatis
        $lastId = Anggota::max('idAnggota');
        $newId = $lastId ? 'A' . str_pad((intval(substr($lastId, 1)) + 1), 3, '0', STR_PAD_LEFT) : 'A001';
        return view('anggota.create', compact('newId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idAnggota' => 'required|unique:anggotas|max:10',
            'nama' => 'required|max:50',
            'alamat' => 'nullable|max:100',
            'no_telp' => 'nullable|max:15',
            'email' => 'nullable|email|max:50',
            'tgl_daftar' => 'required|date',
            'status' => 'required|in:Aktif,Non-Aktif'
        ]);

        Anggota::create($request->all());
        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil ditambahkan');
    }

    public function edit($id)
    {
        $anggota = Anggota::findOrFail($id);
        return view('anggota.edit', compact('anggota'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|max:50',
            'alamat' => 'nullable|max:100',
            'no_telp' => 'nullable|max:15',
            'email' => 'nullable|email|max:50',
            'tgl_daftar' => 'required|date',
            'status' => 'required|in:Aktif,Non-Aktif'
        ]);

        $anggota = Anggota::findOrFail($id);
        $anggota->update($request->all());
        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil diperbarui');
    }

    public function destroy($id)
    {
        $anggota = Anggota::findOrFail($id);
        
        if ($anggota->peminjamans()->where('status_pinjam', 'Dipinjam')->count() > 0) {
            return redirect()->route('anggota.index')->with('error', 'Anggota masih memiliki peminjaman aktif!');
        }
        
        $anggota->delete();
        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil dihapus');
    }
    
    public function cekAnggota($id)
    {
        $anggota = Anggota::find($id);
        if ($anggota) {
            return response()->json(['exists' => true, 'nama' => $anggota->nama, 'status' => $anggota->status]);
        }
        return response()->json(['exists' => false]);
    }
}