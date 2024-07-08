<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class template_resep_detail extends Model
{
    use HasFactory;
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $table = 'erm_template_resep_detail';
    protected $connection = 'mysql2';
    protected $guarded = ['id'];
}
