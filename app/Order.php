<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    public function ordersubs(){
        return $this->hasMany(OrderSub::class);
    }
}
