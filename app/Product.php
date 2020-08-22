<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    public function promotions(){
        return $this->hasMany(Promotion::class);
    }
    public function type(){
        return $this->belongsTo(Type::class);
    }
    public function ordersubs(){
        return $this->hasMany(OrderSub::class);
    }

    //mant to many ดูว่าใครซื้อ
    public function users(){
        return $this->belongsToMany(User::class, 'carts', 'product_id', 'user_id')->withPivot('qty')->withTimestamps();
    }
}
