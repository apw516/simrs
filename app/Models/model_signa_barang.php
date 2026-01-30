<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class model_signa_barang extends Model
{
    use HasFactory;
    use HasFactory;
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $connection = 'mysql';
    protected $table = 'master_signa_barang_x_dpho_bpjs';
    protected $guarded = [];
}
