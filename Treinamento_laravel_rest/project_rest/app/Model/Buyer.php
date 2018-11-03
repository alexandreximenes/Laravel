<?php

namespace App\Model;

use App\Model\Transaction;
use App\User;

class Buyer extends User
{
    public function transactions(){
        return $this->hasMany(Transaction::class);
    }
}
