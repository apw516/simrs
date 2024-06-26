<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class erm_mata_kanan_kiri extends Model
{
    use HasFactory;
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $connection = 'mysql4';
    protected $table = 'erm_mata_kanan_kiri';
    protected $guarded = ['id'];
}
