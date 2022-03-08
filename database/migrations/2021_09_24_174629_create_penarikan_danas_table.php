<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenarikanDanasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penarikan_danas', function (Blueprint $table) {
            $table->id();
            $table->string('kode_unik');
            $table->unsignedBigInteger('id_seller');
            $table->float('total');
            $table->float('biaya_layanan');
            $table->string('keterangan');
            $table->integer('status');
            $table->string('pemeritahuan')->nullable();
            $table->date('tanggal_penarikan');
            $table->timestamps();

            $table->foreign('id_seller')->references('id')->on('sellers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penarikan_danas');
    }
}
