<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbPromoSupplier extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_promo_supplier', function (Blueprint $table) {
            $table->increments('id_promo_supplier');
            $table->integer('id_supplier')->unsigned();
            $table->foreign('id_supplier')->references('id_supplier')->on('tb_supplier')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('tb_promo_supplier');
    }
}
