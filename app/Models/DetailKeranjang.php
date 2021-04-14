<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailKeranjang extends Model
{
    use HasFactory;
    protected $table = 'tb_detail_keranjang';
    protected $primaryKey = 'id_detail_keranjang';
    protected $fillable = [
        'id_keranjang',
        'id_produk',
        'jumlah_produk'
        //tambahin total harga
    ];
    public $timestamps = true;
}
