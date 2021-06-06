<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailStokOpname extends Model
{
    use HasFactory;
    protected $table = 'tb_detail_stok_opname';
    protected $primaryKey = 'id_detail_stok_opname';
    protected $fillable = [
        'id_stok_opname',
        'tgl_stok_opname',
        'id_produk',
        'stok_awal',
        'stok_masuk',
        'stok_keluar',
        'stok_sistem',
        'stok_fisik',
        'selisih',
        'keterangan'
    ];
    public $timestamps = false;
}
