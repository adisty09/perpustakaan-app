<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penerbit extends Model
{
    protected $table = 'penerbits';
    protected $primaryKey = 'idPenerbit';
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = [
        'idPenerbit', 'nama', 'alamat', 'no_telp', 'email'
    ];
    
    public function bukus()
    {
        return $this->hasMany(Buku::class, 'idPenerbit', 'idPenerbit');
    }
}
