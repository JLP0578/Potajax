<?php

namespace App\Http\Controllers;

use App\Shops\Categorie;
use App\Shops\Moderation;
use App\Shops\Shop;
use App\Shops\SubCategorie;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Image;

class ManageSiteController extends Controller
{
    public function __construct()
    {
       $this->middleware('moderatorOrAdmin');
    }

    public function index()
    {
        return view('pages.manage-site');
    }

    // gestion des catégories / sous catégories
    public function categories()
    {
        $categories = Categorie::with('subcategories')->get();
        return view('pages.manage-categories', [
            'categories' => $categories
        ]);
    }

    public function subcategories($category_id)
    {
        $category = Categorie::find($category_id);
        $subcategories = SubCategorie::where('category_id', $category_id)->get();
        return view('pages.manage-subcategories', [
            'category' => $category,
            'subcategories' => $subcategories
        ]);
    }

    public function postAddSubcategory(Request $request, $category_id)
    {
        $request->validate([
            'name' => 'required|string'
        ]);
        Categorie::findOrFail($category_id);
        if(SubCategorie::where('libelle', $request->name)->where('category_id', $category_id)->count() > 0)
            return redirect()->back();
        SubCategorie::create([
            'libelle' => $request->name,
            'category_id'=> $category_id
        ]);
        return redirect()->back()->with('success', 'Création réussie');
    }

    public function postAddCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'image.*' => 'mimes:jpeg,jpg,png|max:2048',
            'image' => 'required'
        ]);

        if(Categorie::where('libelle', $request->name)->count() > 0) return redirect()->back();
        $category = Categorie::create([
            'libelle' => $request->name,
        ]);
        $name = $category->libelle;
        $url = '/img/Size_Small/';
        $img_name = $name.'.jpg';
        $filePath = public_path($url);
        $img = Image::make($request->file('image')->path());
        $img->resize(150, 150, function ($const) {
            $const->aspectRatio();
        })->save($filePath.'/'.$img_name, 90, 'jpg');

//        dd($request->file('image')->move($filePath, $img_name));
        return redirect()->back()->with('success', 'Création réussie');
    }

    public function getUpdateCategory($category_id)
    {
        $category = Categorie::findOrFail($category_id);
        return view('pages.update-category', [
            'category' => $category
        ]);
    }

    public function postUpdateCategory(Request $request, $category_id)
    {
        $category = Categorie::findOrFail($category_id);
        $request->validate([
            'name' => 'required|string',
            'image.*' => 'mimes:jpeg,jpg,png|max:2048',
            'image' => 'required'
        ]);
        $category->libelle = $request->name;
        $category->save();

        $name = $category->libelle;
        $url = '/img/Size_Small/';
        $img_name = $name.'.jpg';
        $filePath = public_path($url);
        $img = Image::make($request->file('image')->path());
        $img->resize(150, 150, function ($const) {
            $const->aspectRatio();
        })->save($filePath.'/'.$img_name, 90, 'jpg');
        return redirect()->back()->with('success', 'Modification réussie');
    }

    public function postUpdateSubcategory(Request $request, $subcategory_id, $category_id)
    {
        $category = Categorie::findOrFail($category_id);
        $subcategory = SubCategorie::findOrFail($subcategory_id);
        $request->validate([
            'name' => 'required|string'
        ]);
        $subcategory->libelle = $request->name;
        $subcategory->save();
        return redirect()
            ->back()
            ->with('success', 'Modification réussie');
    }

    public function getUpdateSubcategory($subcategory_id, $category_id)
    {
        $subcategory = SubCategorie::findOrFail($subcategory_id);
        $category = Categorie::findOrFail($category_id);
        return view('pages.update-subcategory', [
            'category' => $category,
            'subcategory' => $subcategory
        ]);
    }

    // Modération Shop
    public function rejectShop(Request $request, $shop_id)
    {
        $request->validate(
            [ 'motifRefus' => 'required' ]
        );
        $shop = Shop::findOrFail($shop_id);
        $shop->etat = Shop::REJECTED;
        $shop->save();

        Moderation::updateOrCreate(
            ['shop_id' => $shop->id, 'user_id' => Auth::id()],
            [
                'modifRefus' => $request->motifRefus,
                'date' => Carbon::now(),
                'user_id' => Auth::id(),
                'shop_id' => $shop->id
            ]
        );

        if(preg_match('/(shop)/', request()->headers->get('referer'))) {
            return redirect()->route('Allmap')->with('success', 'La modération a bien été prise en compte');
        }
        return redirect()->back()->with('success', 'La modération a bien été prise en compte');
    }

    public function validateShop($shop_id)
    {
        $shop = Shop::findOrFail($shop_id);
        $shop->etat = Shop::VALID;
        $shop->save();
        return redirect()->back()->with('success', 'la modération a bien été prise en compte');
    }

    public function shops()
    {
        $shops = Shop::where('etat','0')->get();
        return view('pages.manage-shops', [
            'shops' => $shops
        ]);
    }

    public function getModerateShop($shop_id)
    {
        $shop = Shop::findOrFail($shop_id);
        return view('pages.moderate-shop', [
            'shop' => $shop
        ]);
    }
}
