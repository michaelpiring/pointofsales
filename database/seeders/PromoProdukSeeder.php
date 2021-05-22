<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PromoProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_promo_produk')->insert([
            'id_promo_produk' => 1,
            'id_produk' => 1,
            'kode_promo' => '547kjf',
            'besar_promo_diskon' => 2500,
            'tgl_mulai_diskon' => '2021-05-15',
            'tgl_berakhir_diskon' => '2021-05-25',
            'keterangan' => 'Diskon produk',
            'status' => 'aktif'
        ]);
        DB::table('tb_promo_produk')->insert([
            'id_promo_produk' => 2,
            'id_produk' => 2,
            'kode_promo' => '795sfl',
            'besar_promo_diskon' => 3500,
            'tgl_mulai_diskon' => '2021-05-15',
            'tgl_berakhir_diskon' => '2021-05-25',
            'keterangan' => 'Diskon produk',
            'status' => 'aktif'
        ]);
        DB::table('tb_promo_produk')->insert([
            'id_promo_produk' => 3,
            'id_produk' => 3,
            'kode_promo' => '741swo',
            'besar_promo_diskon' => 1500,
            'tgl_mulai_diskon' => '2021-05-15',
            'tgl_berakhir_diskon' => '2021-05-25',
            'keterangan' => 'Diskon produk',
            'status' => 'aktif'
        ]);
        DB::table('tb_promo_produk')->insert([
            'id_promo_produk' => 4,
            'id_produk' => 4,
            'kode_promo' => '671eiw',
            'besar_promo_diskon' => 500,
            'tgl_mulai_diskon' => '2021-05-15',
            'tgl_berakhir_diskon' => '2021-05-25',
            'keterangan' => 'Diskon produk',
            'status' => 'aktif'
        ]);
        DB::table('tb_promo_produk')->insert([
            'id_promo_produk' => 5,
            'id_produk' => 5,
            'kode_promo' => '794kjf',
            'besar_promo_diskon' => 750,
            'tgl_mulai_diskon' => '2021-05-15',
            'tgl_berakhir_diskon' => '2021-05-25',
            'keterangan' => 'Diskon produk',
            'status' => 'aktif'
        ]);
    }
}
