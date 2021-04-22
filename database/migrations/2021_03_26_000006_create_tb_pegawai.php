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
            $table->integer('id_toko')->unsigned();
            $table->foreign('id_toko')->references('id_toko')->on('tb_toko')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('id_jabatan')->unsigned();
            $table->foreign('id_jabatan')->references('id_jabatan')->on('tb_jabatan')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('id_divisi')->unsigned();
            $table->foreign('id_divisi')->references('id_divisi')->on('tb_divisi')->onDelete('restrict')->onUpdate('cascade');
            $table->string('nama_pegawai');
            $table->string('email_pegawai')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password_pegawai');
            $table->string('nik_pegawai', 15)->unique();
            $table->string('alamat_pegawai', 100);
            $table->date('tgl_lahir_pegawai');
            $table->enum('status',['aktif','nonaktif']);
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
