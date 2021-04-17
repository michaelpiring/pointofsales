<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_pegawai')->insert([
            'id_pegawai' => 1,
            'id_toko' => 1,
            'id_jabatan' => 1,
            'id_divisi' => 1,
    		'nama_pegawai' =>'admin',
            'email_pegawai' => 'admin@gmail.com',
            'password_pegawai' => bcrypt('admin'),
            'nik_pegawai' => '123456789',
            'alamat_pegawai' => 'Jalan Bali',
            'tgl_lahir_pegawai' => '1999-12-01',
        ]);
    }
}
