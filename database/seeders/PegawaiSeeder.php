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
            'email_pegawai' => 'admin@gmail.com',
            'password_pegawai' => bcrypt('admin'),
            'nik_pegawai' => '123456789',
            'alamat_pegawai' => 'Jalan Bali',
            'tgl_lahir_pegawai' => '1999-12-01',
            'status' => 'aktif'
        ]);

        $faker = Faker::create();

        $id_jabatan = DB::table('tb_jabatan')->pluck('id_jabatan');
        $id_divisi = DB::table('tb_divisi')->pluck('id_divisi');

        for($i=2;$i<=8;$i++){
            DB::table('tb_pegawai')->insert([
                'id_pegawai' => $i,
                'id_toko' => 1,
                'id_jabatan' => $faker->randomElement($id_jabatan),
                'id_divisi' => $faker->randomElement($id_divisi),
                'nama_pegawai' => $faker->firstName,
                'email_pegawai' => $faker->email,
                'password_pegawai' => bcrypt($faker->name),
                'nik_pegawai' => $faker->numberBetween($min = 100000, $max = 200000),
                'alamat_pegawai' => $faker->address,
                'tgl_lahir_pegawai' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'status' => 'aktif'
    		]);
        }
    }
}
