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
            $table->enum('kategori', ['Kelas 1', 'Kelas 2', 'Kelas 3', 'Kelas 4', 'Kelas 5', 'Kelas 6', 'Umum']);
            $table->enum('topik', ['Matematika', 'Seni Budaya', 'IPA', 'IPS', 'PJOK', 'Bahasa Inggris', 'Bahasa Indonesia', 'Novel', 'Sains', 'Sejarah']);
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
