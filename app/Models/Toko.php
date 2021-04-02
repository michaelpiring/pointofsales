<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    use HasFactory;
    protected $table = 'tb_toko';
    protected $primaryKey = 'id_toko';
    protected $fillable = [
        'nama_toko',
        'alamat_toko',
        'no_telepon_toko',
        'status'
    ];
    public $timestamps = true;
}
