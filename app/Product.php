<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'category_id',
        'qte',
        'price',
    ];

    public function category(){
        return $this->belongsTo('\App\Category','category_id','id');
    }


}
