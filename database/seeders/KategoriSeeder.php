<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_kategori')->insert([
            'id_kategori' => 1,
            'id_toko' => 1,
    		'kategori' =>'Makanan',
            'status' => 'aktif'
        ]);
        DB::table('tb_kategori')->insert([
            'id_kategori' => 2,
            'id_toko' => 1,
    		'kategori' =>'Minuman',
            'status' => 'aktif'
        ]);
        DB::table('tb_kategori')->insert([
            'id_kategori' => 3,
            'id_toko' => 1,
    		'kategori' =>'Sembako',
            'status' => 'aktif'
        ]);
        DB::table('tb_kategori')->insert([
            'id_kategori' => 4,
            'id_toko' => 1,
    		'kategori' =>'Peralatan Mandi & Mencuci',
            'status' => 'aktif'
        ]);
        DB::table('tb_kategori')->insert([
            'id_kategori' => 5,
            'id_toko' => 1,
    		'kategori' =>'Alat Tulis',
            'status' => 'aktif'
        ]);
        DB::table('tb_kategori')->insert([
            'id_kategori' => 6,
            'id_toko' => 1,
    		'kategori' =>'Perlengkapan Rumah Tangga',
            'status' => 'aktif'
        ]);
        DB::table('tb_kategori')->insert([
            'id_kategori' => 7,
            'id_toko' => 1,
    		'kategori' =>'Obat-Obatan',
            'status' => 'aktif'
        ]);
        DB::table('tb_kategori')->insert([
            'id_kategori' => 8,
            'id_toko' => 1,
    		'kategori' =>'Lain-lain',
            'status' => 'aktif'
        ]);

    }
}
