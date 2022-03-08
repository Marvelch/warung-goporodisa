<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ongkir extends Model
{
    protected $table = 'ongkirs';

    protected $fillable = [
        'id_lokasi_awal',
        'id_lokasi_akhir',
        'tarif',
    ];
}
