<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    protected $guarded = ['tanggal_pengembalian'];
    protected $primaryKey = 'kode_peminjaman';
    protected $keyType = 'string';
    public $incrementing = 'false';
}
