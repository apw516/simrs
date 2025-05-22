<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mt_antrian_farmasi_header extends Model
{
    use HasFactory;
    protected $connection = 'mysql5';
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $table = 'erm_antrian_farmasi';
    protected $guarded = ['id'];
}
