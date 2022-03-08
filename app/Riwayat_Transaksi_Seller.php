<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Riwayat_Transaksi_Seller extends Model
{
    protected $table = 'riwayat__transaksi__sellers';

    protected $fillable = [
        'id_seller',
        'id_rincian_transaksi',
        'kode_transaksi',
        'total',
        'status_transaksi',
        'status_penarikan',
        'tanggal',
        'konfirmasi_pelanggan',
        'tanggal_kadaluarsa_konfirmasi',
    ];

}
