<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        $this->call(DivisiSeeder::class);
        $this->call(JabatanSeeder::class);
        $this->call(TokoSeeder::class);
        $this->call(KategoriSeeder::class);
        $this->call(SupplierSeeder::class);
        $this->call(PromoDiskonSeeder::class);
        $this->call(PegawaiSeeder::class);
        $this->call(ProdukSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CheckoutSeeder::class);
        $this->call(PenjualanSeeder::class);
        $this->call(PembelianSeeder::class);
        $this->call(PromoProdukSeeder::class);
    }
}
