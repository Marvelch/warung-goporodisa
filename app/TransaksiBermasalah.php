<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiBermasalah extends Model
{
    protected $table = 'transaksi_bermasalahs';

    protected $fillable = [
        'kode_transaksi',
        'tanggal_pelaporan',
        'keterangan',
        'status_laporan',
    ];
}
