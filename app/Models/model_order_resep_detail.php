<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class model_order_resep_detail extends Model
{
    use HasFactory;
    protected $connection = 'mysql5';
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $table = 'order_farmasi_detail';
    protected $guarded = ['id'];
}
