<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $connection = 'mysql2';
    protected $table = 'mt_pasien';
    protected $guarded = ['idx'];
    public function Desa(){
        return $this->hasOne(Desa::class,'id','kode_desa');
    }
    public function Pekerjaan(){
        return $this->hasOne(Pekerjaan::class,'ID','pekerjaan');
    }
    public function Pendidikan(){
        return $this->hasOne(Pendidikan::class,'ID','pendidikan');
    }
    public function Agama(){
        return $this->hasOne(Agama::class,'ID','agama');
    }
    public function Provinsi(){
        return $this->hasOne(Provinsi::class,'id','propinsi');
    }
    public function Kabupaten(){
        return $this->hasOne(Kabupaten::class,'id','kabupaten');
    }
    public function Kecamatan(){
        return $this->hasOne(Kecamatan::class,'id','kecamatan');
    }
}
