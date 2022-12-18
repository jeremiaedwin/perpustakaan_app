<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggotas', function (Blueprint $table) { 
            $table->string('nis_anggota',10)->primary();
            $table->unsignedBigInteger('id_user');
            $table->string('nama_anggota');
            $table->string('alamat_anggota');
            $table->string('nomor_telepon_anggota');
            $table->string('email_anggota');
            $table->integer('tahun_ajaran');
            $table->string('status_anggota')->default('aktif');
            $table->timestamps();
            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anggotas');
    }
}
