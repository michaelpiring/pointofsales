<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TokoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_toko')->insert([
            'id_toko' => 1,
    		'nama_toko' =>'Toko Cabang Denpasar',
            'alamat_toko' => 'Jalan Denpasar',
            'no_telepon_toko' => '081234567',
            'status' => 'aktif'
        ]);
    }
}
