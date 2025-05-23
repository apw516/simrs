<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mt_bhp_detail extends Model
{
    use HasFactory;
     protected $connection = 'mysql5';
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $table = 'mt_bhp_detail';
    protected $guarded = ['id'];
}
