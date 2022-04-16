<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hubkeluarga extends Model
{
    use HasFactory;
    protected $table = 'mt_hub_keluarga';
    protected $connection = 'mysql2';
}
