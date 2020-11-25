<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'vendor_id',
        'user_id',
        'total_amount',
    ];

    
    public function PurchaseDetail()
    {
        return $this->hasMany('App\PurchaseDetail', 'purchase_id', 'id');
    }
    

    public function vendor(){
        return $this->hasOne('\App\vendor','id','vendor_id');
    }

    
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
