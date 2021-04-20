<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_jabatan')->insert([
            'id_jabatan' => 1,
            'jabatan' => 'Manager'
        ]);
        DB::table('tb_jabatan')->insert([
            'id_jabatan' => 2,
            'jabatan' => 'Staff Kasir'
        ]);
        DB::table('tb_jabatan')->insert([
            'id_jabatan' => 3,
            'jabatan' => 'Staff Gudang'
        ]);
    }
}
