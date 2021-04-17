<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbPenjualan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_penjualan', function (Blueprint $table) {
            $table->increments('id_penjualan');
            $table->integer('id_toko')->unsigned();
            $table->foreign('id_toko')->references('id_toko')->on('tb_toko')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('id_pegawai')->unsigned();
            $table->foreign('id_pegawai')->references('id_pegawai')->on('tb_pegawai')->onDelete('restrict')->onUpdate('cascade');            
            $table->dateTime('tgl_penjualan');
            $table->integer('total_penjualan');
            $table->enum('status', ['sudah dibayar','belum dibayar']);
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
        Schema::dropIfExists('tb_penjualan');
    }
}
