<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogPeminjamanSuccess extends Model
{
    use HasFactory;
    protected $table ='log_peminjaman_successes';
    protected $guarded = [];

}
