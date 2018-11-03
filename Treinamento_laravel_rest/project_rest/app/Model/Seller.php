<?php

namespace App\Model;

use App\Model\Product;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    public function products(){
        $this->hasMany(Product::class);
    }
}
