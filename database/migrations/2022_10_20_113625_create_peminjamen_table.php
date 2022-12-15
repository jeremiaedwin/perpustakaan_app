<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->string('kode_peminjaman', 8)->primary();
            $table->string('kode_anggota');
            $table->string('kode_buku');
            $table->integer('durasi_peminjaman');
            $table->date('tanggal_peminjaman');
            $table->timestamps();
            $table->foreign('kode_anggota')->references('nis_anggota')->on('anggotas');
            $table->foreign('kode_buku')->references('id_buku')->on('data_buku');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peminjamen');
    }
}