<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbPromoProduk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_promo_produk', function (Blueprint $table) {
            $table->increments('id_promo_produk');
            $table->integer('id_produk')->unsigned();
            $table->foreign('id_produk')->references('id_produk')->on('tb_produk')->onDelete('restrict')->onUpdate('cascade');
            $table->string('kode_promo')->unique();
            $table->integer('besar_promo_diskon');
            $table->date('tgl_mulai_diskon');
            $table->date('tgl_berakhir_diskon');
            $table->text('keterangan');
            $table->enum('status',['aktif', 'non aktif']);
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
        Schema::dropIfExists('tb_promo_produk');
    }
}
