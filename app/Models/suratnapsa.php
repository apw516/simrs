<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class suratnapsa extends Model
{
    use HasFactory;
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $table = 'ts_mcu_narkoba';
    protected $guarded = ['id_surat'];
}
