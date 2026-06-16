<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
     protected $table = 'pengembalians';
    protected $primaryKey = 'idPengembalian';
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = [
        'idPengembalian', 'tglKembali_real', 'keterlambatanHari', 'dendaDibayar', 'idPeminjaman', 'idPustakawan'
    ];
    
    protected $casts = [
        'tglKembali_real' => 'date',
        'dendaDibayar' => 'decimal:2'
    ];
    
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'idPeminjaman', 'idPeminjaman');
    }
    
    public function pustakawan()
    {
        return $this->belongsTo(Pustakawan::class, 'idPustakawan', 'idPustakawan');
    }
}
