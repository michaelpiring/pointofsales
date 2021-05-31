<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdatePromoProduk extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:promoproduk';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Status Promo Produk';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        DB::table('tb_promo_produk')->where('tgl_berakhir_diskon', '<=', now())->update(['status' => 'non aktif']);
    }
}
