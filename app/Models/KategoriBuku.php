<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBuku extends Model
{
    use HasFactory;

    use HasFactory;
    protected $table = 'kategori_buku';
    protected $fillable = [
        'id_buku',
        'judul_buku',
        'penerbit_buku',
        'penulis_buku',
        'jumlah_stok',
        'jumlah_tersedia'
    ];
    protected $primaryKey = 'id_buku';
    protected $keyType = 'string';
    public $incrementing = 'false';
}