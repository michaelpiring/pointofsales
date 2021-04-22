<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbKategori extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_kategori', function (Blueprint $table) {
            $table->increments('id_kategori');
            $table->integer('id_toko')->unsigned();
            $table->foreign('id_toko')->references('id_toko')->on('tb_toko')->onDelete('restrict')->onUpdate('cascade');
            $table->string('kategori', 45);
            $table->enum('status',['aktif','nonaktif']);
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
        Schema::dropIfExists('tb_kategori');
    }
}
