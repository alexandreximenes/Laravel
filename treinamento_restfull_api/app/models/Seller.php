<?php

namespace App;

class Seller extends User
{
    public function transactions(){
        return $this->hasMany(Transaction::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }
}
