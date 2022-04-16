<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ts_kunjungan extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table = 'ts_kunjungan';
    protected $guarded = ['kode_kunjungan'];
}
