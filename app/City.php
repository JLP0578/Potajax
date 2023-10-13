<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $casts = ['id' => 'string'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
