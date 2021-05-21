<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;

use Faker\Provider\DateTime;

class CheckoutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        DB::table('tb_checkout')->insert([
            'id_checkout' => 1,
            'id_keranjang' => 1,
            'id_user' => 1,
            'tgl_checkout' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null),
            'kode_promo' => '-',
            'metode_pembayaran' => 'cash',
            'total_harga' => 100000,
            'pajak' => 1500,
            'total_checkout' => 101500,
            'status' => 'sudah dibayar'
        ]);
    }
}
