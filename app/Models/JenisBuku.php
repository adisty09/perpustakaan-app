<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisBuku extends Model
{
    protected $table = 'jenis_bukus';
    protected $primaryKey = 'idJenis';
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = [
        'idJenis', 'namaJenis', 'deskripsi'
    ];
    
    public function bukus()
    {
        return $this->hasMany(Buku::class, 'idJenis', 'idJenis');
    }
}
