<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'tb_produk';
    protected $primaryKey = 'id_produk';
    protected $fillable = [
        'id_supplier',
        'id_kategori',
        'nama_produk',
        'stok',
        'harga_produk',
        'berat_produk',
        'deskripsi_produk',
        'foto_produk',
        'kode_barcode',
        'status_produk'
    ];
    public $timestamps = true;
}
