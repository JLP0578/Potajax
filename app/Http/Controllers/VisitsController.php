<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shops\Shop;
use App\Shops\Visit;

class VisitsController extends Controller
{
    // Fonction statique pour ajouter une visite au clic

    public static function addVisit($id)
    {
    	// $shop = Shop::findOrFail($id);

    	$visit = Visit::create(['dateHeure' => now(), 'shop_id' => $id]);
    }
}
