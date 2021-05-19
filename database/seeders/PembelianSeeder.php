<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

use App\Models\Pembelian;
use App\Models\DetailPembelian;

class PembelianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $id_pegawai = DB::table('tb_pegawai')->pluck('id_pegawai');
        $id_produk = DB::table('tb_produk')->pluck('id_produk');
        $id_supplier = DB::table('tb_supplier')->pluck('id_supplier');
        
        //triwulan 1
        for($i=1;$i<=20;$i++){
            $create_pembelian = Pembelian::create([
                'id_pembelian' => $i,
                'id_toko' => 1,
                'id_pegawai' => $faker->randomElement($id_pegawai),
    			'id_produk' => $faker->randomElement($id_produk),
                'id_supplier' => $faker->randomElement($id_supplier),
                'tgl_pembelian' => '2020-03-10',
                'jumlah_barang' => 50,
                'total_pembelian' => 750000,
                'harga_beli' => 15000,
                'status' => 'success',
    		]);

        }
        //triwulan 2
        for($i=21;$i<=40;$i++){
            $create_pembelian = Pembelian::create([
                'id_pembelian' => $i,
                'id_toko' => 1,
                'id_pegawai' => $faker->randomElement($id_pegawai),
    			'id_produk' => $faker->randomElement($id_produk),
                'id_supplier' => $faker->randomElement($id_supplier),
                'tgl_pembelian' => '2020-06-10',
                'jumlah_barang' => 50,
                'total_pembelian' => 750000,
                'harga_beli' => 15000,
                'status' => 'success',
    		]);
            
        }
        //triwulan 3
        for($i=41;$i<=60;$i++){
            $create_pembelian = Pembelian::create([
                'id_pembelian' => $i,
                'id_toko' => 1,
                'id_pegawai' => $faker->randomElement($id_pegawai),
    			'id_produk' => $faker->randomElement($id_produk),
                'id_supplier' => $faker->randomElement($id_supplier),
                'tgl_pembelian' => '2020-09-10',
                'jumlah_barang' => 50,
                'total_pembelian' => 750000,
                'harga_beli' => 15000,
                'status' => 'success',
    		]);
            
        
        }
        //triwulan 4
        for($i=61;$i<=80;$i++){
            $create_pembelian = Pembelian::create([
                'id_pembelian' => $i,
                'id_toko' => 1,
                'id_pegawai' => $faker->randomElement($id_pegawai),
    			'id_produk' => $faker->randomElement($id_produk),
                'id_supplier' => $faker->randomElement($id_supplier),
                'tgl_pembelian' => '2020-12-10',
                'jumlah_barang' => 50,
                'total_pembelian' => 750000,
                'harga_beli' => 15000,
                'status' => 'success',
    		]);
            
        }
        //triwulan 5
        for($i=81;$i<=100;$i++){
            $create_pembelian = Pembelian::create([
                'id_pembelian' => $i,
                'id_toko' => 1,
                'id_pegawai' => $faker->randomElement($id_pegawai),
    			'id_produk' => $faker->randomElement($id_produk),
                'id_supplier' => $faker->randomElement($id_supplier),
                'tgl_pembelian' => '2021-03-10',
                'jumlah_barang' => 50,
                'total_pembelian' => 750000,
                'harga_beli' => 15000,
                'status' => 'success',
    		]);
            
        }
        //triwulan 6
        for($i=101;$i<=120;$i++){
            $create_pembelian = Pembelian::create([
                'id_pembelian' => $i,
                'id_toko' => 1,
                'id_pegawai' => $faker->randomElement($id_pegawai),
    			'id_produk' => $faker->randomElement($id_produk),
                'id_supplier' => $faker->randomElement($id_supplier),
                'tgl_pembelian' => '2021-06-10',
                'jumlah_barang' => 50,
                'total_pembelian' => 750000,
                'harga_beli' => 15000,
                'status' => 'success',
    		]);
            
        }
        //triwulan 7
        for($i=121;$i<=140;$i++){
            $create_pembelian = Pembelian::create([
                'id_pembelian' => $i,
                'id_toko' => 1,
                'id_pegawai' => $faker->randomElement($id_pegawai),
    			'id_produk' => $faker->randomElement($id_produk),
                'id_supplier' => $faker->randomElement($id_supplier),
                'tgl_pembelian' => '2021-09-10',
                'jumlah_barang' => 50,
                'total_pembelian' => 750000,
                'harga_beli' => 15000,
                'status' => 'success',
    		]);
            

        }
        //triwulan 8
        for($i=141;$i<=160;$i++){
            $create_pembelian = Pembelian::create([
                'id_pembelian' => $i,
                'id_toko' => 1,
                'id_pegawai' => $faker->randomElement($id_pegawai),
    			'id_produk' => $faker->randomElement($id_produk),
                'id_supplier' => $faker->randomElement($id_supplier),
                'tgl_pembelian' => '2021-12-10',
                'jumlah_barang' => 50,
                'total_pembelian' => 750000,
                'harga_beli' => 15000,
                'status' => 'success',
    		]);
        }
    }
}
