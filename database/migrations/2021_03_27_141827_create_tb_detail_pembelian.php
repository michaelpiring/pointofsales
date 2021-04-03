<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbDetailPembelian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_detail_pembelian', function (Blueprint $table) {
            $table->increments('id_detail_pembelian');
            $table->integer('id_pembelian')->unsigned();
            $table->foreign('id_pembelian')->references('id_pembelian')->on('tb_pembelian')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('id_toko')->unsigned();
            $table->foreign('id_toko')->references('id_toko')->on('tb_toko')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('id_pegawai')->unsigned();
            $table->foreign('id_pegawai')->references('id_pegawai')->on('tb_pegawai')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('id_produk')->unsigned();
            $table->foreign('id_produk')->references('id_produk')->on('tb_produk')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('id_supplier')->unsigned();
            $table->foreign('id_supplier')->references('id_supplier')->on('tb_supplier')->onDelete('restrict')->onUpdate('cascade');
            $table->datetime('tgl_pembelian');
            $table->integer('jumlah_barang');
            $table->integer('total_pembelian');
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
        Schema::dropIfExists('tb_detail_pembelian');
    }
}
