<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbPromoDiskon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_promo_diskon', function (Blueprint $table) {
            $table->increments('id_promo_diskon');
            $table->date('tgl_mulai_diskon');
            $table->date('tgl_berakhir_diskon');
            $table->integer('besar_promo_diskon');
            $table->text('keterangan');
            $table->string('gambar_promo_diskon');
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
        Schema::dropIfExists('tb_promo_diskon');
    }
}
