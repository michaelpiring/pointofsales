<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retur extends Model
{
    use HasFactory;
    protected $table = 'tb_retur';
    protected $primaryKey = 'id_retur';
    protected $fillable = [
        'id_toko',
        'id_produk',
        'id_pegawai',
        'id_supplier',
        'jumlah_barang',
        'keterangan',
        'tgl_retur',
        'status'      
    ];
    public $timestamps = true;
}
