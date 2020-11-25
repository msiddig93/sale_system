<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    protected $fillable = [
        'purchase_id',
        'product_id',
        'qte',
        'price',
    ];

    public function product(){
        return $this->hasOne('\App\Product','id','product_id');
    }
}
