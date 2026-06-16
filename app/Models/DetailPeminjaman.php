<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPeminjaman extends Model
{
    protected $table = 'detail_peminjamans';
    
    protected $fillable = [
        'idPeminjaman', 'idBuku', 'status_kembali'
    ];
    
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'idPeminjaman', 'idPeminjaman');
    }
    
    public function buku()
    {
        return $this->belongsTo(Buku::class, 'idBuku', 'idBuku');
    }
    
    public function isSudahKembali()
    {
        return $this->status_kembali === 'Sudah';
    }
}
