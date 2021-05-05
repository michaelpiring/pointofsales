<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        DB::table('users')->insert([ 
            'id' => 1,
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('user'),
    		'alamat_user' =>'Jalan Denpasar',
            'tgl_lahir_user' => '1999-01-01',
            'jenis_kelamin_user' => 'laki laki',
            'total_poin_user' => 0,
            'saldo_hutang' => 0,
            'status' => 'aktif',
            'created_at' => $faker->date($format = 'Y-m-d', $max = 'now')
        ]);

        DB::table('tb_keranjang')->insert([
            'id_keranjang' => 1,
            'id_user'       => 1,
            'jumlah_produk' => 0,
        ]);

        

        $id_jabatan = DB::table('tb_jabatan')->pluck('id_jabatan');
        $id_divisi = DB::table('tb_divisi')->pluck('id_divisi');

        for($i=2;$i<=9;$i++){
            DB::table('users')->insert([
                'id' => $i,
                'name' => $faker->firstName,
                'email' => $faker->email,
                'password' => bcrypt($faker->firstName),
                'alamat_user' => $faker->address,
                'tgl_lahir_user' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'jenis_kelamin_user' => 'laki laki',
                'total_poin_user' => 0,
                'saldo_hutang' => 0,
                'status' => 'aktif',
                'created_at' => $faker->date($format = 'Y-m-d', $max = 'now')
    		]);
            DB::table('tb_keranjang')->insert([
                'id_keranjang' => $i,
                'id_user'       => $i,
                'jumlah_produk' => 0,
            ]); 
        }

        for($i=10;$i<=20;$i++){
            DB::table('users')->insert([
                'id' => $i,
                'name' => $faker->firstName,
                'email' => $faker->email,
                'password' => bcrypt($faker->firstName),
                'alamat_user' => $faker->address,
                'tgl_lahir_user' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'jenis_kelamin_user' => 'perempuan',
                'total_poin_user' => 0,
                'saldo_hutang' => 0,
                'status' => 'aktif',
                'created_at' => $faker->date($format = 'Y-m-d', $max = 'now')
    		]);
            DB::table('tb_keranjang')->insert([
                'id_keranjang' => $i,
                'id_user'       => $i,
                'jumlah_produk' => 0,
            ]); 
        }
    }
}
