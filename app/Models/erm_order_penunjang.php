<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class erm_order_penunjang extends Model
{
    use HasFactory;
    protected $table = 'erm_order_penunjang';
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $connection = 'mysql4';
    protected $guarded = ['id'];
}
