<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;
    protected $table = 'tb_pembelian';
    protected $primaryKey = 'id_pembelian';
    protected $fillable = [
        'id_toko',
        'id_pegawai',
        'id_produk',
        'id_supplier',
        'tgl_pembelian'
    ];
    public $timestamps = true;
}
