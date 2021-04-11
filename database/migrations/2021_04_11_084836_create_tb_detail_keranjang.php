<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbDetailKeranjang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_detail_keranjang', function (Blueprint $table) {
            $table->increments('id_detail_keranjang');
            $table->integer('id_keranjang')->unsigned();
            $table->foreign('id_keranjang')->references('id_keranjang')->on('tb_keranjang')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('id_produk')->unsigned();
            $table->foreign('id_produk')->references('id_produk')->on('tb_produk')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('jumlah_produk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_detail_keranjang');
    }
}
