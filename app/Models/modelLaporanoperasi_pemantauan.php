<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class modelLaporanoperasi_pemantauan extends Model
{
    use HasFactory;
    protected $table = 'pemantauan_erm_laporan_operasi_rajal_7';
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $guarded = ['id'];
}
