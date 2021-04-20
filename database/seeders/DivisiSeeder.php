<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DivisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_divisi')->insert([
            'id_divisi' => 1,
            'divisi' => 'Kasir'
        ]);
        DB::table('tb_divisi')->insert([
            'id_divisi' => 2,
            'divisi' => 'Gudang'
        ]);
    }
}
