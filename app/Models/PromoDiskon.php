<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoDiskon extends Model
{
    use HasFactory;
    protected $table = 'tb_promo_diskon';
    protected $primaryKey = 'id_promo_diskon';
    protected $fillable = [
        'id_toko',
        'kode_promo',
        'besar_promo_diskon',
        'tgl_mulai_diskon',
        'tgl_berakhir_diskon',
        'keterangan',
        'status'        
    ];
    public $timestamps = true;
}
