<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    //
    public function store_type(){
        return $this->belongsTo(StoreType::class);
    }
}
