<?php

namespace App;

use App\Model\Category;
use App\Model\Seller;
use App\Model\Transaction;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected const AVAILABLE_PRODUCT = 'available';
    protected const UNAVAILABLE_PRODUCT = 'unavailable';
    protected $fillable = [
        'nome',
        'description',
        'quantity',
        'status',
        'image',
        'seller_id'
    ];

    public function isAvailable(){
        return $this->status == Product::AVAILABLE_PRODUCT;
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
