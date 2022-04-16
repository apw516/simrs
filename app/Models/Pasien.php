<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table = 'mt_pasien';
    public function Desa(){
        return $this->hasOne(Desa::class,'id','kode_desa');
    }
}
