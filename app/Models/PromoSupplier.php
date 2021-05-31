<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoSupplier extends Model
{
    use HasFactory;
    protected $table = 'tb_promo_supplier';
    protected $primaryKey = 'id_promo_supplier';
    protected $fillable = [
        'id_supplier',
        'kode_promo',
        'besar_promo_diskon',
        'tgl_mulai_diskon',
        'tgl_berakhir_diskon',
        'keterangan',
        'status'        
    ];
    public $timestamps = true;
}
