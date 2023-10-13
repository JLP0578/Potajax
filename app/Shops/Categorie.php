<?php

namespace App\Shops;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $fillable = ['libelle'];
    public function shops()
    {
        return $this->hasMany(Shop::class);
    }

    public function subCategories()
    {
        return $this->hasMany(SubCategorie::class, 'category_id');
    }
}
