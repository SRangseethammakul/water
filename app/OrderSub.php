<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderSub extends Model
{
    //
    public function order(){
        return $this->belongsTo(Order::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
