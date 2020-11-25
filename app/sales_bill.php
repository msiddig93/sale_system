<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class sales_bill extends Model
{
    protected $fillable = [
        'user_id',
        'total_amount',
    ];

    public function product(){
        return $this->hasMany('\App\Product','sales_bill_id','id');
    }

    
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    
}
