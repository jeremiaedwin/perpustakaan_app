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
            $table->string('id_anggota', 10)->primary();
            $table->string('nis_anggota');
            $table->string('nama_anggota');
            $table->string('alamat_anggota');
            $table->string('nomor_telepon_anggota');
            $table->string('email_anggota');
            $table->string('status_anggota')->default('aktif');
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
        Schema::dropIfExists('anggotas');
    }
}
