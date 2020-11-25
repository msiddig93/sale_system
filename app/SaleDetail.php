<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    protected $fillable = [
        'sales_bill_id',
        'product_id',
        'qte',
        'price',
    ];

    public function product(){
        return $this->hasOne('\App\Product','id','product_id');
    }
}
