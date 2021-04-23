<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbCheckout extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_checkout', function (Blueprint $table) {
            $table->increments('id_checkout');
            $table->integer('id_keranjang')->unsigned();
            $table->foreign('id_keranjang')->references('id_keranjang')->on('tb_keranjang')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->datetime('tgl_checkout');
            $table->string('kode_promo');
            $table->enum('metode_pembayaran',['cash','split','hutang']);
            $table->integer('total_harga');
            $table->integer('pajak');
            $table->integer('total_checkout');
            $table->enum('status',['sudah dibayar', 'belum dibayar']);
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
        Schema::dropIfExists('tb_checkout');
    }
}
