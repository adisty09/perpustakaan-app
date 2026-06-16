<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Peminjaman extends Model
{
     protected $table = 'peminjamans';
    protected $primaryKey = 'idPeminjaman';
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = [
        'idPeminjaman', 'tglPinjam', 'lamaPinjam', 'tgl_jatuh_tempo', 'status_pinjam', 'idAnggota', 'idPustakawan'
    ];
    
    protected $casts = [
        'tglPinjam' => 'date',
        'tgl_jatuh_tempo' => 'date'
    ];
    
    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'idAnggota', 'idAnggota');
    }
    
    public function pustakawan()
    {
        return $this->belongsTo(Pustakawan::class, 'idPustakawan', 'idPustakawan');
    }
    
    public function detailPeminjamans()
    {
        return $this->hasMany(DetailPeminjaman::class, 'idPeminjaman', 'idPeminjaman');
    }
    
    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class, 'idPeminjaman', 'idPeminjaman');
    }
    
    public function isTerlambat()
    {
        if ($this->status_pinjam != 'Dipinjam') return false;
        return Carbon::now()->gt($this->tgl_jatuh_tempo);
    }
    
    public function getHariTerlambatAttribute()
    {
        if ($this->status_pinjam != 'Dipinjam') return 0;
        $terlambat = Carbon::now()->diffInDays($this->tgl_jatuh_tempo, false);
        return $terlambat > 0 ? $terlambat : 0;
    }
}
