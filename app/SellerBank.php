<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellerBank extends Model
{
    protected $table = 'seller_banks';

    protected $fillable = [
        'id',
        'id_seller',
        'id_bank',
        'nama_pemilik_rekening',
        'nomor_rekening',
    ];

    public function Banks(){
        return $this->belongsto('App\Bank','id_bank');
    }
}
