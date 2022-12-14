<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataBukuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_buku', function (Blueprint $table) {
            $table->string('id_buku')->primary();
            $table->string('judul_buku');
            $table->string('penerbit_buku');
            $table->string('penulis_buku');
            $table->integer('jumlah_stok');
            $table->integer('jumlah_tersedia');
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
        Schema::dropIfExists('data_buku');
    }
}
