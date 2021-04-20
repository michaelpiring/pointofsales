<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        
        for($i=1;$i<=10;$i++){
            DB::table('tb_supplier')->insert([
                'id_supplier' => $i,
                'nama_supplier' => $faker->company,
                'alamat_supplier' => $faker->address,
    			'no_telepon_supplier' => $faker->numberBetween($min = 1000000, $max = 9000000),
    		]);
        }
    }
}
