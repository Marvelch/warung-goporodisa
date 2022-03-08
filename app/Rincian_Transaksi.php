<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rincian_Transaksi extends Model
{
    protected $table = 'rincian_transaksis';

    protected $fillable = [
        'id',
        'kode_transaksi',
        'id_jualanku',
        'harga_barang',
        'jumlah_pesanan',
        'berat_barang',
        'id_alamat_pengirim',
        'id_alamat_penerima',
        'status_pesanan_per_transaksi',
        'id_seller',
        'id_toko',
        'ket_stok',
    ];

}
