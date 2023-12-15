<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogPengembalianSuccessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_pengembalian_success', function (Blueprint $table) {
            $table->id();
            $table->string('kode_peminjaman');
            $table->string('status');
            $table->string('message');
            $table->string('method');
            $table->string('url');
            $table->string('ip');
            $table->string('user_agent');
            $table->string('user_id');
            $table->string('action');
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
        Schema::dropIfExists('log_pengembalian_success');
    }
}
