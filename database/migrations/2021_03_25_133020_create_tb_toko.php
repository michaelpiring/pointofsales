<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbToko extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_toko', function (Blueprint $table) {
            $table->increments('id_toko');
            $table->string('nama_toko', 30);
            $table->string('alamat_toko', 100);
            $table->string('no_telepon_toko', 20);
            $table->enum('status',['aktif','non aktif']);
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
        Schema::dropIfExists('tb_toko');
    }
}
