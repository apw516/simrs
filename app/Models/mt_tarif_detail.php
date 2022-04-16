<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mt_tarif_detail extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table = 'mt_tarif_detail';
    public function mt_tarif_detail(){
        return $this->hasOne(mt_tarif_header::class,'KODE_TARIF_HEADER','KODE_TARIF_HEADER');
    }
}
