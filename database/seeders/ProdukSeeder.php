<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_produk')->insert([
            'id_produk' => 1,
    		'id_supplier' => 1,
            'id_kategori' => 1,
            'nama_produk' => 'Okky Jelly Drink',
            'stok' => 0,
            'harga_produk' => 5000,
            'berat_produk' => 250,
            'deskripsi_produk' => 'Minuman Jelly',
            'foto_produk' => '',
            'kode_barcode' => '0000001'
        ]);
    }
}
