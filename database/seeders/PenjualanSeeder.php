<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

use Faker\Provider\DateTime;

use App\Models\Penjualan;
use App\Models\DetailPenjualan;

class PenjualanSeeder extends Seeder
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
        $id_user = DB::table('users')->pluck('id');
        

        for($i=1;$i<=200;$i++){
            $create_penjualan = Penjualan::create([
                'id_penjualan' => $i,
                'id_toko' => 1,
                'id_user' => $faker->randomElement($id_user),
                'id_pegawai' => $faker->randomElement($id_pegawai),
    			'tgl_penjualan' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null),
                'total_penjualan' => $faker->numberBetween($min = 25000, $max = 200000),
                'status' => 'sudah dibayar',
    		]);
            
            $id_produk = DB::table('tb_produk')->pluck('id_produk');

            DetailPenjualan::create([
                'id_detail_penjualan' => $i,
                'id_penjualan' => $create_penjualan['id_penjualan'],
                'id_toko' => $create_penjualan['id_toko'],
                'id_user' => $create_penjualan['id_user'],
                'id_pegawai' => $create_penjualan['id_pegawai'],
    			'id_produk' => $faker->randomElement($id_produk),
                'tgl_penjualan' => $create_penjualan['tgl_penjualan'],
                'jumlah_produk' => $faker->numberBetween($min = 10, $max = 75),
                'total_harga' => $create_penjualan['total_penjualan'],
    		]);
        }
    }
}
