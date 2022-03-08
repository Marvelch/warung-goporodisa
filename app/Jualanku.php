<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jualanku extends Model
{
    protected $table = 'jualankus';

    protected $fillable = [
        'nama_barang',
        'gmbr_depan',
        'gmbr_kiri',
        'gmbr_kanan',
        'gmbr_belakang',
        'id_kategori',
        'harga',
        'id_seller',
        'status',
        'kondisi',
        'id_lokasi',
        'jumlah',
        'id',
        'berat',
        'merek',
        'deskripsi',
    ];

    public function Kategoris() {
        return $this->belongsto('App\Kategori','id_kategori');
    }
}
