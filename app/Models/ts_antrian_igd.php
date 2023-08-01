<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ts_antrian_igd extends Model
{
    use HasFactory;
    protected $connection = 'mysql4';
    protected $table = 'ts_antrian_igd';
    const UPDATED_AT = null;
    protected $guarded = ['id'];
}
