<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    use HasFactory;
    protected $table = 'tb_detail_penjualan';
    protected $primaryKey = 'id_detail_penjualan';
    protected $fillable = [
        'id_penjualan',
        'id_checkout',
        'id_toko',
        'id_user',
        'id_pegawai',
        'id_produk',
        'tgl_penjualan',
        'jumlah_produk',
        'total_harga'
    ];
    public $timestamps = true;
}
