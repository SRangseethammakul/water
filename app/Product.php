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
}
