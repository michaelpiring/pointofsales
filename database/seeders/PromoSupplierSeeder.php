<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PromoSupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_promo_supplier')->insert([
            'id_promo_supplier' => 1,
            'id_supplier' => 1,
            'kode_promo' => 'supplier1',
            'besar_promo_diskon' => 2500,
            'tgl_mulai_diskon' => '2021-05-15',
            'tgl_berakhir_diskon' => '2021-05-25',
            'keterangan' => 'Diskon supplier1',
            'status' => 'aktif'
        ]);
        DB::table('tb_promo_supplier')->insert([
            'id_promo_supplier' => 2,
            'id_supplier' => 2,
            'kode_promo' => 'supplier2',
            'besar_promo_diskon' => 1500,
            'tgl_mulai_diskon' => '2021-05-15',
            'tgl_berakhir_diskon' => '2021-05-25',
            'keterangan' => 'Diskon supplier2',
            'status' => 'aktif'
        ]);
    }
}
