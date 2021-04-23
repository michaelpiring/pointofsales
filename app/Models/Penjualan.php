<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;
    protected $table = 'tb_penjualan';
    protected $primaryKey = 'id_penjualan';
    protected $fillable = [
        'id_checkout',
        'id_toko',
        'id_user',
        'id_pegawai',
        'tgl_penjualan',
        'total_checkout',
        'total_penjualan',
        'metode_pembayaran',
        'status'
    ];
    public $timestamps = true;
}
