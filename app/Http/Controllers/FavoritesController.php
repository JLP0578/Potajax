<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FavoritesController extends Controller
{
    public function get(Request $request)
    {
        FavoritesController::post($request);
    }

    public function index()
    {
        /*if (auth()->check()) {
            // On récupère l'id de l'utilisateur connecté

            $user_id = Auth::id();

            // On va chercher en BDD les magasins mis en favoris par l'utilisateur connecté

            $shops = DB::table('shops')->join('favorites', 'id', '=', 'favorites.shop_id')
                ->where('favorites.user_id', '=', $user_id)
                ->get();

            // On envoie les magasins récupérés en BDD à la vue fav

            return view('pages.fav', [
                'shops' => $shops
            ]);
        }
        else{*/
            return view('pages.fav');
        //}
        /*$shops = DB::table('shops')->where('shop_id', '=', $_COOKIE['id'])
                                   ->get();

        // On envoie les magasins récupérés en BDD à la vue fav grâce au localStorage

        return view('pages.fav', [
            'shops' => $shops
        ]);*/
        //}
    }


    /*public function add(Request $request)
    {
        //{{route('add-favorites', $infos->id)}}
        if(auth()->check()){
            $id = $request->input('search');
            Favorite::create([
                    'user_id' => auth()->id(),
                    'shop_id' => $id
                ]
            );
        }
    }*/

    static public function post(Request $request)
    {
        //dd($request->input('0'));

        $type = $request->input('0')['type'];

        if ($type === 'create') {
            if (auth()->check()) {
                $id = $request->input('id');
                $favorite = Favorite::firstOrCreate([
                        'user_id' => auth()->id(),
                        'shop_id' => $id
                    ]
                );
                return json_encode($favorite);
            }
            else{
                return json_encode('pas Co');
            }
        } else if ($type === 'read') {
            /**/

            if($request->input('1') !== [] && !empty($request->input('1'))){

                $shops = null;
                //dd($request->all());
                foreach ($request->input('1') as $idShop) {
                    $shops[] = DB::table('shops')->
                    select('shops.id', 'shops.nom', 'shops.lat', 'shops.lng', 'shops.descriptif', 'shops.adresse', 'cities.nom as Cit_nom', 'cities.cp as Cit_cp', 'shops.subcategory_id', 'shops.category_id', 'subcategories.libelle as SubCat_libelle', 'categories.libelle as Cat_libelle', 'shops.created_at', 'shops.updated_at', 'shops.deleted_at')->
                    leftJoin('categories', 'categories.id', '=', 'shops.category_id')->
                    leftJoin('subcategories', 'subcategories.id', '=', 'shops.subcategory_id')->
                    leftJoin('cities', 'cities.id', '=', 'shops.city_id')->
                    where('shops.id', $idShop)->
                    orderBy('shops.id')->
                    get();
                }
                //dd(json_encode($shops));
                //return FavoritesController::Fetch($shops);
                return json_encode(FavoritesController::Fetch($shops));
            } else {
                if(auth()->check()){
                    $shops_[] = select('shops.id', 'shops.nom', 'shops.lat', 'shops.lng', 'shops.descriptif', 'shops.adresse', 'cities.nom as Cit_nom', 'cities.cp as Cit_cp', 'shops.subcategory_id', 'shops.category_id', 'subcategories.libelle as SubCat_libelle', 'categories.libelle as Cat_libelle', 'shops.created_at', 'shops.updated_at', 'shops.deleted_at')->
                    leftJoin('categories', 'categories.id', '=', 'shops.category_id')->
                    leftJoin('subcategories', 'subcategories.id', '=', 'shops.subcategory_id')->
                    leftJoin('cities', 'cities.id', '=', 'shops.city_id')->
                    leftJoin('favorites', 'favorites.shop_id', '=', 'shops.id')->
                    where('favorites.user_id', auth()->id)->
                    orderBy('shops.id')->
                    get();

                    return json_encode(FavoritesController::Fetch($shops_));
                }
                else {
                    return json_encode('pas Co');
                }
            }
            //}
        } else if ($type === 'remove') {
            if (auth()->check()) {
                $favorite = DB::table('favorites')
                    ->where('id', $request->input('1'))
                    ->delete();
                return json_encode($favorite);
            }
            else{
                return json_encode('pas Co');
            }
        }
    }
    static public function Fetch($cats)
    {
        $lesCategorie = [];
        foreach ($cats as $cat) {
            foreach ($cat as $ct) {
                $lesCategorie[] = $ct;
            }
        }
        return $lesCategorie;
    }


        /*if(count($request->all()) > 1){
            //if (auth()->check()) {

                /*$shops = null;
                foreach ($request->all() as $idShop) {
                    $shops[] = DB::table('shops')->
                    select('shops.id', 'shops.nom', 'shops.lat', 'shops.lng', 'shops.descriptif', 'shops.adresse', 'shops.subcategory_id', 'shops.category_id', 'subcategories.libelle as sub_libelle', 'categories.libelle as libelle', 'shops.created_at', 'shops.updated_at', 'shops.deleted_at')->
                    join('categories', 'categories.id', '=', 'shops.category_id')->
                    join('subcategories', 'subcategories.id', '=', 'shops.subcategory_id')->
                    join('cities', 'cities.id', '=', 'shops.city_id')->
                    where('shops.id', $idShop)->
                    orderBy('shops.id')->
                    get();
                }
                dd(json_encode($shops));
                return json_encode($shops);*/


            //} else {
            /*$shops = null;
            foreach ($request->all() as $idShop){

                $shops[] = DB::table('shops')->
                select('shops.id','shops.nom','shops.lat','shops.lng','shops.descriptif','shops.adresse','shops.subcategory_id','shops.category_id','subcategories.libelle as sub_libelle','categories.libelle as libelle','shops.created_at','shops.updated_at','shops.deleted_at')->
                join('categories', 'categories.id', '=', 'shops.category_id')->
                join('subcategories', 'subcategories.id', '=', 'shops.subcategory_id')->
                join('cities', 'cities.id', '=', 'shops.city_id')->
                where('shops.id', $idShop)->
                orderBy('shops.id')->
                get();
            }*/
            //dd(json_encode($shops));
            //return json_encode($shops);
            //}

        //} elseif (count($request->all()) === 1){
            //{{route('add-favorites', $infos->id)}}
            /*if (auth()->check()) {
                $id = $request->input('id');
                $favorite = Favorite::firstOrCreate([
                        'user_id' => auth()->id(),
                        'shop_id' => $id
                    ]
                );
                return json_encode($favorite);
            } else {
                return json_encode('pas Co');
            }
        }
    }*/



}
