<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

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
            'id_toko' => 1,
            'nama_produk' => 'Roti Coklat',
            'stok' => 100,
            'harga_produk' => 5000,
            'harga_beli' => 3000,
            'berat_produk' => 250,
            'deskripsi_produk' => 'Roti Coklat',
            'foto_produk' => '',
            'kode_barcode' => '0000001',
            'status_produk' => '1'
        ]);
        DB::table('tb_produk')->insert([
            'id_produk' => 2,
    		'id_supplier' => 2,
            'id_kategori' => 2,
            'id_toko' => 1,
            'nama_produk' => 'Energen',
            'stok' => 100,
            'harga_produk' => 3000,
            'harga_beli' => 2500,
            'berat_produk' => 100,
            'deskripsi_produk' => 'Minuman Energi',
            'foto_produk' => '',
            'kode_barcode' => '0000002',
            'status_produk' => '1'
        ]);
        DB::table('tb_produk')->insert([
            'id_produk' => 3,
    		'id_supplier' => 3,
            'id_kategori' => 3,
            'id_toko' => 1,
            'nama_produk' => 'Beras 1kg',
            'stok' => 100,
            'harga_produk' => 10000,
            'harga_beli' => 7000,
            'berat_produk' => 1000,
            'deskripsi_produk' => 'Beras 1kg',
            'foto_produk' => '',
            'kode_barcode' => '0000003',
            'status_produk' => '1'
        ]);
        DB::table('tb_produk')->insert([
            'id_produk' => 4,
    		'id_supplier' => 4,
            'id_kategori' => 4,
            'id_toko' => 1,
            'nama_produk' => 'Sabun Lifebuoy',
            'stok' => 100,
            'harga_produk' => 5000,
            'harga_beli' => 3000,
            'berat_produk' => 250,
            'deskripsi_produk' => 'Sabun Batang Lifebuoy',
            'foto_produk' => '',
            'kode_barcode' => '0000004',
            'status_produk' => '1'
        ]);
        DB::table('tb_produk')->insert([
            'id_produk' => 5,
    		'id_supplier' => 5,
            'id_kategori' => 5,
            'id_toko' => 1,
            'nama_produk' => 'Pensil',
            'stok' => 50,
            'harga_produk' => 3000,
            'harga_beli' => 1500,
            'berat_produk' => 50,
            'deskripsi_produk' => 'Pensil Kayu',
            'foto_produk' => '',
            'kode_barcode' => '0000005',
            'status_produk' => '1'
        ]);
        DB::table('tb_produk')->insert([
            'id_produk' => 6,
    		'id_supplier' => 6,
            'id_kategori' => 6,
            'id_toko' => 1,
            'nama_produk' => 'Sapu Lidi',
            'stok' => 30,
            'harga_produk' => 12000,
            'harga_beli' => 8000,
            'berat_produk' => 250,
            'deskripsi_produk' => 'Sapu Lidi',
            'foto_produk' => '',
            'kode_barcode' => '0000006',
            'status_produk' => '1'
        ]);
        DB::table('tb_produk')->insert([
            'id_produk' => 7,
    		'id_supplier' => 7,
            'id_kategori' => 7,
            'id_toko' => 1,
            'nama_produk' => 'Panadol',
            'stok' => 50,
            'harga_produk' => 10000,
            'harga_beli' => 7000,
            'berat_produk' => 75,
            'deskripsi_produk' => 'Panadol Sakit Kepala',
            'foto_produk' => '',
            'kode_barcode' => '0000007',
            'status_produk' => '1'
        ]);
        DB::table('tb_produk')->insert([
            'id_produk' => 8,
    		'id_supplier' => 8,
            'id_kategori' => 8,
            'id_toko' => 1,
            'nama_produk' => 'Susu Bayi',
            'stok' => 30,
            'harga_produk' => 45000,
            'harga_beli' => 38000,
            'berat_produk' => 500,
            'deskripsi_produk' => 'Susu Bubuk Bayi',
            'foto_produk' => '',
            'kode_barcode' => '0000008',
            'status_produk' => '1'
        ]);
        DB::table('tb_produk')->insert([
            'id_produk' => 9,
    		'id_supplier' => 1,
            'id_kategori' => 1,
            'id_toko' => 1,
            'nama_produk' => 'Biskuit',
            'stok' => 50,
            'harga_produk' => 8000,
            'harga_beli' => 5000,
            'berat_produk' => 200,
            'deskripsi_produk' => 'Biskuit',
            'foto_produk' => '',
            'kode_barcode' => '0000009',
            'status_produk' => '1'
        ]);
        DB::table('tb_produk')->insert([
            'id_produk' => 10,
    		'id_supplier' => 2,
            'id_kategori' => 2,
            'id_toko' => 1,
            'nama_produk' => 'Air Aqua',
            'stok' => 50,
            'harga_produk' => 5000,
            'harga_beli' => 3000,
            'berat_produk' => 250,
            'deskripsi_produk' => 'Air Mineral Aqua',
            'foto_produk' => '',
            'kode_barcode' => '0000010',
            'status_produk' => '1'
        ]);
    }
}
