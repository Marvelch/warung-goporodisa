<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatTransaksiSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat__transaksi__sellers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_seller');
            $table->unsignedBigInteger('id_rincian_transaksi');
            $table->string('kode_transaksi');
            $table->float('total');
            $table->integer('status_transaksi');
            $table->integer('status_penarikan')->nullable();
            $table->date('tanggal');
            $table->timestamps();

            $table->foreign('id_seller')->references('id')->on('sellers');
            $table->foreign('id_rincian_transaksi')->references('id')->on('rincian_transaksis');
            $table->foreign('kode_transaksi')->references('kode_transaksi')->on('transaksis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayat__transaksi__sellers');
    }
}
