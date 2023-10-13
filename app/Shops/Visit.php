<?php

namespace App\Shops;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
	protected $fillable = [
        'shop_id', 'created_at'
    ];

   	public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
