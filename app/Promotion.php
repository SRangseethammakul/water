<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    //
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
