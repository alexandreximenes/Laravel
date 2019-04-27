<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    const UNAVAILABLE_PRODUT = 'unavailable';
    const AVAILABLE_PRODUT = 'available';

    protected $fillable = [
        'name',
        'description',
        'quantity',
        'status',
        'image',
        'seller_id',
    ];

    public function isAvailable(){
        return $this->status == self::AVAILABLE_PRODUT;
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function seller(){
        return $this->belongsTo(Seller::class);
    }

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }
}
