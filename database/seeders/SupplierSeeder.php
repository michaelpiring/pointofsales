<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_supplier')->insert([
            'id_supplier' => 1,
    		'nama_supplier' =>'Toko Karya',
            'alamat_supplier' => 'Jalan Monang Maning',
            'no_telepon_supplier' => '081234567'
        ]);
    }
}
