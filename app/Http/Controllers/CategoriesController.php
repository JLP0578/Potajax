<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shops\Categorie;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{
    public function listCat()
    {
        $categories = Categorie::all();
        $auth = Auth::user();
        return view('pages.home', [
            'categories' => $categories,
            'auth' => $auth
        ]);
    }

    public function apiGetCategories()
    {
        $categories = Categorie::with('subcategories')->get();
        return $categories->toJson();
    }
}
