<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->string('kode_peminjaman', 8)->primary();
            $table->string('id_anggota');
            $table->foreign('id_anggota')->references('id_anggota')->on('anggotas')->onDelete('cascade');
            $table->string('id_buku');
            $table->foreign('id_buku')->references('id_buku')->on('data_buku')->onDelete('cascade');
            $table->date('tanggal_peminjaman');
            $table->integer('durasi_peminjaman');
            $table->date('tanggal_pengembalian')->nullable();
            
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
        Schema::dropIfExists('transactions');
    }
}
