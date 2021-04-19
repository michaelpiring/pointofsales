<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbDetailStokOpnameSementara extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_detail_stok_opname_sementara', function (Blueprint $table) {
            $table->increments('id_detail_stok_opname_sementara');
            $table->integer('id_stok_opname');
            $table->integer('id_produk');
            $table->integer('stok_masuk');
            $table->integer('stok_keluar');
            $table->integer('stok_sistem');
            $table->integer('stok_fisik');
            $table->integer('selisih');
            $table->text('keterangan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_detail_stok_opname_sementara');
    }
}
