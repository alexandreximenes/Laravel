<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    const AVAILABLE_PRODUTO = 'available';
    const UNAVAILABLE_PRODUTO = 'unavailable';

    protected $fillable = [
        'name',
        'description',
        'quantity',
        'status',
        'image',
        'seller_id',
    ];
    protected $dates = ['deleted_at'];

    protected $hidden = [
        'pivot'
    ];

    public function isAvailable(){
        return $this->status = self::AVAILABLE_PRODUTO;
    }


    public function transactions(){
        return $this->hasMany(Transaction::class);
    }
    public function sellers(){
        return $this->belongsTo(Seller::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }
}
