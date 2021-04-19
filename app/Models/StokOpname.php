<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokOpname extends Model
{
    use HasFactory;
    protected $table = 'tb_stok_opname';
    protected $primaryKey = 'id_stok_opname';
    protected $fillable = [
        'id_toko',
        'id_pegawai',
        'tgl_stok_opname',
        'status'
    ];
    public $timestamps = false;
}
