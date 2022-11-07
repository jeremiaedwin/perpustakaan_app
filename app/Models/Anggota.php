<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;
    protected $table = 'anggotas';
    protected $fillable = [
        'nis_anggota',
        'nama_anggota',
        'alamat_anggota',
        'nomor_telepon_anggota'
    ];
    protected $primaryKey = 'nis_anggota';
    protected $keyType = 'string';
}
