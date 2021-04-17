<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbStokOpname extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_stok_opname', function (Blueprint $table) {
            $table->increments('id_stok_opname');
            $table->integer('id_produk')->unsigned();
            $table->foreign('id_produk')->references('id_produk')->on('tb_produk')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('id_pegawai')->unsigned();
            $table->foreign('id_pegawai')->references('id_pegawai')->on('tb_pegawai')->onDelete('restrict')->onUpdate('cascade');
            $table->datetime('tgl_stok_opname');
            $table->integer('jumlah_stok');
            $table->integer('triwulan');
            $table->enum('status', ['lengkap','kurang']);
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
        Schema::dropIfExists('tb_stok_opname');
    }
}
