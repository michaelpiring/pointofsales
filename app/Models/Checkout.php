<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;
    protected $table = 'tb_checkout';
    protected $primaryKey = 'id_checkout';
    protected $fillable = [
        'id_keranjang',
        'id_user',
        'tgl_checkout',
        'kode_promo',
        'metode_pembayaran',
        'total_harga',
        'pajak',
        'total_checkout',
        'status'
    ];
    public $timestamps = true;
}
