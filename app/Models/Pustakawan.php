<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pustakawan extends Model
{
    protected $table = 'pustakawans';
    protected $primaryKey = 'idPustakawan';
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = [
        'idPustakawan', 'nama', 'alamat', 'no_telp', 'jabatan', 'gaji_pokok'
    ];
    
    protected $casts = [
        'gaji_pokok' => 'decimal:2'
    ];
    
    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class, 'idPustakawan', 'idPustakawan');
    }
    
    public function pengembalians()
    {
        return $this->hasMany(Pengembalian::class, 'idPustakawan', 'idPustakawan');
    }
}
