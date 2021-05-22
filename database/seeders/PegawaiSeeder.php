<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

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
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'nik_pegawai' => '123456789',
            'alamat_pegawai' => 'Jalan Bali',
            'tgl_lahir_pegawai' => '1999-12-01',
            'status' => 'aktif'
        ]);

        DB::table('tb_pegawai')->insert([
            'id_pegawai' => 2,
            'id_toko' => 1,
            'id_jabatan' => 2,
            'id_divisi' => 2,
    		'nama_pegawai' =>'admingudang',
            'email' => 'admingudang@gmail.com',
            'password' => bcrypt('admingudang'),
            'nik_pegawai' => '321654987',
            'alamat_pegawai' => 'Jalan Jawa',
            'tgl_lahir_pegawai' => '1999-11-21',
            'status' => 'aktif'
        ]);

        $faker = Faker::create();

        $id_jabatan = DB::table('tb_jabatan')->pluck('id_jabatan');
        $id_divisi = DB::table('tb_divisi')->pluck('id_divisi');

        for($i=3;$i<=8;$i++){
            DB::table('tb_pegawai')->insert([
                'id_pegawai' => $i,
                'id_toko' => 1,
                'id_jabatan' => $faker->randomElement($id_jabatan),
                'id_divisi' => $faker->randomElement($id_divisi),
                'nama_pegawai' => $faker->firstName,
                'email' => $faker->email,
                'password' => bcrypt($faker->name),
                'nik_pegawai' => $faker->numberBetween($min = 100000, $max = 200000),
                'alamat_pegawai' => $faker->address,
                'tgl_lahir_pegawai' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'status' => 'aktif'
    		]);
        }
    }
}
