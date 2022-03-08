<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksis';
    
    protected $fillable = [
        'id_user',
        'kode_transaksi',
        'tanggal_transaksi',
        'tanggal_batas_konfirmasi_staff',
        'batas_waktu_pengiriman',
        'metode_pembayaran',
        'biaya_layanan',
        'biaya_pengiriman',
        'total_harga_barang',
        'total_bayar',
        'ketegori_pengiriman',
        'status_pembayaran',
        'status_pesanan',
        'id_staff',
        'id_kurir',
        'status_pengiriman',
        'konfirmasi_pelanggan',
        'tanggal_konfirmasi',
    ];
}
