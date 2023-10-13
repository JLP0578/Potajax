<?php


namespace App\Shops;

use \Illuminate\Database\Eloquent\Model;

class Moderation extends Model
{
    protected $table = 'user_shop';

    protected $fillable = [
        'date', 'modifRefus', 'date', 'shop_id', 'user_id'
    ];
}
