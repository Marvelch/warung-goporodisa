<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellerBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_banks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_seller');
            $table->unsignedBigInteger('id_bank');
            $table->string('nama_pemilik_rekening');
            $table->BigInteger('nomor_rekening');
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('sellers');
            $table->foreign('id_bank')->references('id')->on('banks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seller_banks');
    }
}
