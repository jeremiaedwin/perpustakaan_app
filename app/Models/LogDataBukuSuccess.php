<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogDataBukuSuccess extends Model
{
    use HasFactory;
    protected $table ='log_data_buku_successes';
    protected $guarded = [];
}