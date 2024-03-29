<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbDetailPenjualan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_detail_penjualan', function (Blueprint $table) {
            $table->increments('id_detail_penjualan');
            $table->integer('id_penjualan')->unsigned();
            $table->foreign('id_penjualan')->references('id_penjualan')->on('tb_penjualan')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('id_checkout')->unsigned();
            $table->foreign('id_checkout')->references('id_checkout')->on('tb_checkout')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('id_toko')->unsigned();
            $table->foreign('id_toko')->references('id_toko')->on('tb_toko')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('id_pegawai')->unsigned();
            $table->foreign('id_pegawai')->references('id_pegawai')->on('tb_pegawai')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('id_produk')->unsigned();
            $table->foreign('id_produk')->references('id_produk')->on('tb_produk')->onDelete('restrict')->onUpdate('cascade');
            $table->datetime('tgl_penjualan');
            $table->integer('jumlah_produk');
            $table->integer('total_harga');
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_detail_penjualan');
    }
}
