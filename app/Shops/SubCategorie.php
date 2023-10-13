<?php

namespace App\Shops;

use Illuminate\Database\Eloquent\Model;

class SubCategorie extends Model
{
    protected $table = 'subcategories';
    protected $fillable = ['libelle', 'category_id'];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function shops()
    {
        return $this->hasMany(Shop::class);
    }
}
