<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class assesmenawalperawat extends Model
{
    use HasFactory;
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $connection = 'mysql4';
    protected $table = 'erm_hasil_assesmen_keperawatan_rajal';
    protected $guarded = ['id'];
}
