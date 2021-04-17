<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbHutang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_hutang', function (Blueprint $table) {
            $table->increments('id_hutang');
            $table->integer('id_checkout')->unsigned();
            $table->foreign('id_checkout')->references('id_checkout')->on('tb_checkout')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->datetime('tgl_hutang');
            $table->integer('besar_hutang');
            $table->enum('status',['lunas','belum lunas']);
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
        Schema::dropIfExists('tb_hutang');
    }
}
