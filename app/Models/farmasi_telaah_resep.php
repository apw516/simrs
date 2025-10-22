<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class farmasi_telaah_resep extends Model
{
    use HasFactory;
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $table = 'farmasi_telaah_resep';
    protected $connection = 'mysql6';
    protected $guarded = ['id'];
}
