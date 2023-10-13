<?php

namespace App\Products;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function shop() {
    	return $this->belongsTo(Shop::class);
    }

    public function unit() {
    	return $this->belongsTo(Unit::class);
    }

    public function carts() {
    	return $this->belongsToMany(Cart::class);
    }
}
