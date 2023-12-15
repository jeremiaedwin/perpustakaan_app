<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = 'peminjaman';
    protected $guarded = [];
    protected $primaryKey = 'kode_peminjaman';
    protected $keyType = 'string';
    public $incrementing = 'false';

    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class, 'kode_peminjaman');
    }

    public function anggota()
    {
        return $this->belongsTo(anggota::class, 'kode_anggota');
    }

    public function buku()
    {
        return $this->belongsTo(DataBuku::class, 'kode_buku');
    }
}
