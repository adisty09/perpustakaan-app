<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = 'anggotas';
    protected $primaryKey = 'idAnggota';
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = [
        'idAnggota', 'nama', 'alamat', 'no_telp', 'email', 'tgl_daftar', 'status'
    ];
    
    protected $casts = [
        'tgl_daftar' => 'date'
    ];
    
    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class, 'idAnggota', 'idAnggota');
    }
}
