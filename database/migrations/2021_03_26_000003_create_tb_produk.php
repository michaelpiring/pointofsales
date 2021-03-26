<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbProduk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_produk', function (Blueprint $table) {
            $table->increments('id_produk');
            $table->integer('id_supplier')->unsigned();
            $table->foreign('id_supplier')->references('id_supplier')->on('tb_supplier')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('id_kategori')->unsigned();
            $table->foreign('id_kategori')->references('id_kategori')->on('tb_kategori')->onDelete('restrict')->onUpdate('cascade');
            $table->string('nama_produk', 60);
            $table->integer('stok');
            $table->integer('harga_produk');
            $table->integer('berat_produk');
            $table->string('deskripsi_produk', 199);
            $table->string('foto_produk');
            $table->enum('status_produk', ['aktif', 'non aktif']);
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
        Schema::dropIfExists('tb_produk');
    }
}
