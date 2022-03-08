<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenarikanDana extends Model
{
    protected $table = 'penarikan_danas';

    protected $fillable = [
        'kode_unik',
        'id_seller',
        'total',
        'keterangan',
        'status',
        'pemeritahuan',
        'tanggal_penarikan',
        'biaya_layanan',
        'total_diterima'
    ];
}
