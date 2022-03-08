<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToRiwayatTransaksiSellerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('riwayat__transaksi__sellers', function (Blueprint $table) {
            $table->integer('konfirmasi_pelanggan')->nullable();
            $table->date('tanggal_kadaluarsa_konfirmasi')->nullable();
            $table->date('tanggal_konfirmasi_pelanggan')->nullable();
            $table->unsignedBigInteger('id_user')->nullable();

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
        Schema::table('riwayat__transaksi__sellers', function (Blueprint $table) {
            $table->dropColumn('konfirmasi_pelanggan');
            $table->dropColumn('tanggal_kadaluarsa_konfirmasi');
            $table->dropColumn('tanggal_konfirmasi_pelanggan');
            $table->dropColumn('id_user');
        });
    }
}
