<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ts_antrian_online extends Model
{
    use HasFactory;
    protected $table = 'ts_hasil_bridging_antrian';
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $guarded = ['id'];
}
