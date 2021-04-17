<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PromoDiskonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_promo_diskon')->insert([
            'id_promo_diskon' => 1,
            'id_toko' => 1,
            'kode_promo' => 'ABC123',
            'besar_promo_diskon' => 10000,
            'tgl_mulai_diskon' => '2021-04-16',
            'tgl_berakhir_diskon' => '2021-04-25',
            'keterangan' => 'Diskon April',
            'status' => 'aktif'
        ]);
    }
}
