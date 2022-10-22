<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = 'peminjaman';
    protected $fillable = [
        'kode_peminjaman',
        'kode_peminjam',
        'kode_buku',
        'tanggal_peminjaman',
        'tanggal_pengembalian'
    ];
    protected $primaryKey = 'kode_peminjaman';
    protected $keyType = 'string';
}
