<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    protected $table = 'tokos';

    protected $fillable = [
        'id_seller',
        'id_lokasi',
        'nama_toko',
        'alamat'
    ];

    public function Lokasis() {
        return $this->belongsto('App\Lokasi','id_lokasi');
    }
}
