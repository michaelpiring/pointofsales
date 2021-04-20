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
    		'kategori' =>'Makanan'
        ]);
        DB::table('tb_kategori')->insert([
            'id_kategori' => 2,
    		'kategori' =>'Minuman'
        ]);
        DB::table('tb_kategori')->insert([
            'id_kategori' => 3,
    		'kategori' =>'Sembako'
        ]);
        DB::table('tb_kategori')->insert([
            'id_kategori' => 4,
    		'kategori' =>'Peralatan Mandi & Mencuci'
        ]);
        DB::table('tb_kategori')->insert([
            'id_kategori' => 5,
    		'kategori' =>'Alat Tulis'
        ]);
        DB::table('tb_kategori')->insert([
            'id_kategori' => 6,
    		'kategori' =>'Perlengkapan Rumah Tangga'
        ]);
        DB::table('tb_kategori')->insert([
            'id_kategori' => 7,
    		'kategori' =>'Obat-Obatan'
        ]);
        DB::table('tb_kategori')->insert([
            'id_kategori' => 8,
    		'kategori' =>'Lain-lain'
        ]);

    }
}
