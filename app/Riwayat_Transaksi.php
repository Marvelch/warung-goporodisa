<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Riwayat_Transaksi extends Model
{
    protected $table = 'riwayat__transaksis';

    protected $fillable = [
        'id_user',
        'id_rincian_transaksi',
        'kode_transaksi',
        'total',
        'status_transaksi',
        'status_penarikan',
        'tanggal',
        'status_dana',
    ];
}
