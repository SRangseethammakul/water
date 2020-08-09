<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreType extends Model
{
    //
    public function stores(){
        return $this->hasMany(Store::class);
    }
}
