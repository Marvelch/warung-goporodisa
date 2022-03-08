<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    protected $table = "lokasis";

    protected $fillable = [
        'id',
        'nama_desa',
    ];
}
