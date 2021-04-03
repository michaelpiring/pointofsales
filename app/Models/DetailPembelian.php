<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPembelian extends Model
{
    use HasFactory;
    protected $table = 'tb_detail_pembelian';
    protected $primaryKey = 'id_detail_pembelian';
    protected $fillable = [
        'id_pembelian',
        'tgl_pembelian',
        'jumlah_barang',
        'total_pembelian',
        'id_toko',
        'id_pegawai',
        'id_produk',
        'id_supplier'
    ];
    public $timestamps = true;
}
