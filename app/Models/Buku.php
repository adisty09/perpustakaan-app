<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'bukus';
    protected $primaryKey = 'idBuku';
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = [
        'idBuku', 'judul', 'isbn', 'tahunTerbit', 'stok_total', 'stok_tersedia', 'idPenerbit', 'idJenis'
    ];
    
    public function penerbit()
    {
        return $this->belongsTo(Penerbit::class, 'idPenerbit', 'idPenerbit');
    }
    
    public function jenisBuku()
    {
        return $this->belongsTo(JenisBuku::class, 'idJenis', 'idJenis');
    }
    
    public function pengarangs()
    {
        return $this->belongsToMany(Pengarang::class, 'buku_pengarangs', 'idBuku', 'idPengarang');
    }
    
    public function rakBukus()
    {
        return $this->belongsToMany(RakBuku::class, 'lokasi_bukus', 'idBuku', 'idRak')
                    ->withPivot('jumlah');
    }
    
    public function detailPeminjamans()
    {
        return $this->hasMany(DetailPeminjaman::class, 'idBuku', 'idBuku');
    }
    
    public function isTersedia()
    {
        return $this->stok_tersedia > 0;
    }
}
