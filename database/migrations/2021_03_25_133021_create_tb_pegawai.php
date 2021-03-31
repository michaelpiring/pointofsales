<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbPegawai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_pegawai', function (Blueprint $table) {
            $table->increments('id_pegawai');
            $table->string('nama_pegawai');
            $table->string('email_pegawai')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password_pegawai');
            $table->string('nik_pegawai', 15);
            $table->string('alamat_pegawai', 100);
            $table->datetime('tgl_lahir_pegawai');
            $table->rememberToken();
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
        Schema::dropIfExists('tb_pegawai');
    }
}
