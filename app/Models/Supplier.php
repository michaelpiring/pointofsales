<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $table = 'tb_supplier';
    protected $primaryKey = 'id_supplier';
    protected $fillable = [
        'nama_supplier',
        'alamat_supplier',
        'no_telepon_supplier',
        'status'
    ];
    public $timestamps = true;
}
