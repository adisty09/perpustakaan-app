<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengarang extends Model
{
    protected $table = 'pengarangs';
    protected $primaryKey = 'idPengarang';
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = [
        'idPengarang', 'nama', 'negara', 'tgl_lahir'
    ];
    
    protected $casts = [
        'tgl_lahir' => 'date'
    ];
    
    public function bukus()
    {
        return $this->belongsToMany(Buku::class, 'buku_pengarangs', 'idPengarang', 'idBuku');
    }
}
