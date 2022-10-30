<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogPeminjamanErrorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_peminjaman_errors', function (Blueprint $table) {
            $table->id();
            $table->string('kode_peminjaman');
            $table->string('user_id');
            $table->string('activity');
            $table->string('error_message');
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
        Schema::dropIfExists('log_peminjaman_errors');
    }
}
