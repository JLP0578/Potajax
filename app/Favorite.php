<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
	protected $fillable = [
        'user_id', 'shop_id'
    ];

    public function shops()
    {
        return $this->belongsToMany(Shops\Shop::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
