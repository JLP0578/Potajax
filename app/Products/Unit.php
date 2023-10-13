<?php

namespace App\Products;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    public function products() {
    	return $this->hasMany(Product::class);
    }
}
