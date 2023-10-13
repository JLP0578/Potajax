<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shops\Categorie;
use App\Shops\Shop;
use App\Shops\SubCategorie;

class SubcategoriesController extends Controller
{
    public function listAll(){
        $subcategories = [];

        $categories = Categorie::all();

        $current_category_lib = 'Toute Catégories';
        $current_category_id = 0;

        $current_subcategory_lib = ' ';
        $current_subcategory_id = 0;

        $shops = Shop::all();

        return view('pages.map', [
            'subcategories' => $subcategories,
            'categories' => $categories,

            'current_category_lib' => $current_category_lib,
            'current_category_id' => $current_category_id,

            'current_subcategory_lib' => $current_subcategory_lib,
            'current_subcategory_id' => $current_subcategory_id,

            'shops' => $shops
        ]);
    }
    public function listCat($category_id){
        $subcategories = SubCategorie::where('category_id',$category_id)->get();

        $categories = Categorie::all();

        $current_category_lib = Categorie::findOrFail($category_id)->libelle;
        $current_category_id = Categorie::findOrFail($category_id)->id;

        $current_subcategory_lib = ' ';
        $current_subcategory_id = 0;

        $shops = Shop::where("category_id",$category_id)->get();

        return view('pages.map', [
            'subcategories' => $subcategories,
            'categories' => $categories,

            'current_category_lib' => $current_category_lib,
            'current_category_id' => $current_category_id,

            'current_subcategory_lib' => $current_subcategory_lib,
            'current_subcategory_id' => $current_subcategory_id,

            'shops' => $shops
        ]);
    }
    public function listSubcat($category_id,$subcat_id){
        $subcategories = SubCategorie::where('category_id',$category_id)->get();

        $categories = Categorie::all();

        $current_category_lib = Categorie::findOrFail($category_id)->libelle;
        $current_category_id = Categorie::findOrFail($category_id)->id;

        $current_subcategory_lib = SubCategorie::findOrFail($subcat_id)->libelle;
        $current_subcategory_id = SubCategorie::findOrFail($subcat_id)->id;

        $shops = Shop::where("category_id",$category_id)->where("subcategory_id",$subcat_id)->get();

        return view('pages.map', [
            'subcategories' => $subcategories,
            'categories' => $categories,

            'current_category_lib' => $current_category_lib,
            'current_category_id' => $current_category_id,

            'current_subcategory_lib' => $current_subcategory_lib,
            'current_subcategory_id' => $current_subcategory_id,

            'shops' => $shops
        ]);
    }

}
