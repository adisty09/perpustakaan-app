<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RakBuku extends Model
{
    protected $table = 'rak_bukus';
    protected $primaryKey = 'idRak';
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = [
        'idRak', 'kodeRak', 'lokasi', 'lantai'
    ];
    
    public function bukus()
    {
        return $this->belongsToMany(Buku::class, 'lokasi_bukus', 'idRak', 'idBuku')
                    ->withPivot('jumlah');
    }
}