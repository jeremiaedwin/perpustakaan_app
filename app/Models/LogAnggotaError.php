<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogAnggotaError extends Model
{
    use HasFactory;
    protected $table = 'log_anggota_errors';
    protected $guarted = [];
}
