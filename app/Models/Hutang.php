<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hutang extends Model
{
    use HasFactory;
    protected $table = 'tb_hutang';
    protected $primaryKey = 'id_hutang';
    protected $fillable = [
        'id_checkout',
        'id_user',
        'tgl_hutang',
        'besar_hutang',
        'status'
    ];
    public $timestamps = true;
}
