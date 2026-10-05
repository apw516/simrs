<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TindakanKunjungan extends Model
{
    use HasFactory;
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $connection = 'mysql2';
    protected $table = 'ts_kunjungan_diagnosa_tindakn';
    protected $guarded = ['id'];
}
