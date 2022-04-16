<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;
    protected $table = 'mt_kuota_dokter_poli';
    protected $connection = 'mysql2';
    public function mt_unit(){
        return $this->hasOne(mt_unit::class,'kode_unit','kode_poli');
    }
}
