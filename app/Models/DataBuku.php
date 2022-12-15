<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataBuku extends Model
{
    use HasFactory;

    use HasFactory;
    protected $table = 'data_buku';
    protected $fillable = [
        'id_buku',
        'judul_buku',
        'penerbit_buku',
        'penulis_buku',
        'kategori',
        'topik',
        'jumlah_stok',
        'jumlah_tersedia'
    ];
    protected $primaryKey = 'id_buku';
    protected $keyType = 'string';
    public $incrementing = 'false';

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'id_buku');
    }
}