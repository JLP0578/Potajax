<?php

namespace App\Shops;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    public const MAX_FILES = 4;
    //
    protected $fillable = ['url', 'shop_id'];
    /**
     * @var mixed|string
     */

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
