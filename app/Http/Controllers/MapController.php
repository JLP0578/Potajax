<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//header('Content-type: application/json');

class MapController extends Controller
{
    public function get(Request $request)
    {
        MapController::post($request);
        //dd('Bah nan dsl !!!');
    }

    static function FindCat($tab_cat_id, $tab_subcat_id, $norEst, $sudOue)
    {
        $categories = null;

        if ($tab_subcat_id[0] != null) {

            if ($tab_cat_id[0] == "All" && $tab_subcat_id[0] == "All") {
                $categories[] = DB::table('shops')->
                select('shops.id','shops.nom','shops.lat','shops.lng','shops.descriptif','shops.adresse','cities.nom as nomVille','shops.cp','shops.subcategory_id','shops.category_id','shops.created_at','shops.updated_at','shops.deleted_at')->
                leftJoin('cities', 'cities.id', '=', 'shops.city_id')->
                where('shops.etat', 1)->
                whereBetween('shops.lat', [$sudOue['lat'], $norEst['lat']])->
                whereBetween('shops.lng', [$sudOue['lng'], $norEst['lng']])->
                get();
            } else if ($tab_subcat_id[0] == "All") {
                $categories[] = DB::table('shops')->
                select('shops.id','shops.nom','shops.lat','shops.lng','shops.descriptif','shops.adresse','cities.nom as nomVille','shops.cp','shops.subcategory_id','shops.category_id','subcategories.libelle','shops.created_at','shops.updated_at','shops.deleted_at')->
                leftJoin('categories', 'categories.id', '=', 'shops.category_id')->
                leftJoin('subcategories', 'subcategories.id', '=', 'shops.subcategory_id')->
                leftJoin('cities', 'cities.id', '=', 'shops.city_id')->
                where('shops.category_id', $tab_cat_id[0])->
                where('shops.etat', 1)->
                whereBetween('shops.lat', [$sudOue['lat'], $norEst['lat']])->
                whereBetween('shops.lng', [$sudOue['lng'], $norEst['lng']])->
                orderBy('shops.nom')->
                get();
            } else {
                $categories[] = DB::table('shops')->
                select('shops.id','shops.nom','shops.lat','shops.lng','shops.descriptif','shops.adresse','cities.nom as nomVille','shops.cp','shops.subcategory_id','shops.category_id','subcategories.libelle','shops.created_at','shops.updated_at','shops.deleted_at')->
                leftJoin('categories', 'categories.id', '=', 'shops.category_id')->
                leftJoin('subcategories', 'subcategories.id', '=', 'shops.subcategory_id')->
                leftJoin('cities', 'cities.id', '=', 'shops.city_id')->
                where('shops.category_id', $tab_cat_id[0])->
                where('shops.subcategory_id', $tab_subcat_id[0])->
                where('shops.etat', 1)->
                whereBetween('shops.lat', [$sudOue['lat'], $norEst['lat']])->
                whereBetween('shops.lng', [$sudOue['lng'], $norEst['lng']])->
                orderBy('shops.nom')->
                get();
            }
        }

        if ($tab_subcat_id[0] == null) {
            $categories[] = DB::table('shops')->
            select('shops.id','shops.nom','shops.lat','shops.lng','shops.descriptif','shops.adresse','cities.nom as nomVille','shops.cp','shops.subcategory_id','shops.category_id','subcategories.libelle','shops.created_at','shops.updated_at','shops.deleted_at')->
            leftJoin('categories', 'categories.id', '=', 'shops.category_id')->
            leftJoin('subcategories', 'subcategories.id', '=', 'shops.subcategory_id')->
            leftJoin('cities', 'cities.id', '=', 'shops.city_id')->
            where('shops.category_id', $tab_cat_id[0])->
            where('shops.etat', 1)->
            whereBetween('shops.lat', [$sudOue['lat'], $norEst['lat']])->
            whereBetween('shops.lng', [$sudOue['lng'], $norEst['lng']])->
            orderBy('shops.nom')->
            get();
        }
        //dd($tab_cat_id[0]);

        //dd($categories);
        return MapController::Fetch($categories);
    }

    static function FindSearch($search){
        $shops = null;

        if ($search != null) {

            $shops[] = DB::table('shops')->
            select('shops.id','shops.nom','shops.lat','shops.lng','shops.descriptif','shops.adresse','cities.nom as nomVille','shops.cp','shops.subcategory_id','shops.category_id','subcategories.libelle','shops.created_at','shops.updated_at','shops.deleted_at')->
            leftJoin('categories', 'categories.id', '=', 'shops.category_id')->
            leftJoin('subcategories', 'subcategories.id', '=', 'shops.subcategory_id')->
            leftJoin('cities', 'cities.id', '=', 'shops.city_id')->
            where('shops.nom', 'Like','%' . $search . '%')->
            where('shops.etat', 1)->
            orderBy('shops.nom')->
            get();

            if(count($shops[0]) > 0){
                return MapController::Fetch($shops);
            }else {
                $shops[] = DB::table('shops')->
                select('shops.id','shops.nom','shops.lat','shops.lng','shops.descriptif','shops.adresse','cities.nom as nomVille','shops.cp','shops.subcategory_id','shops.category_id','subcategories.libelle','shops.created_at','shops.updated_at','shops.deleted_at')->
                leftJoin('categories', 'categories.id', '=', 'shops.category_id')->
                leftJoin('subcategories', 'subcategories.id', '=', 'shops.subcategory_id')->
                leftJoin('cities', 'cities.id', '=', 'shops.city_id')->
                where('subcategories.libelle', 'Like','%' . $search . '%')->
                where('shops.etat', 1)->
                orderBy('shops.nom')->
                get();

                if(count($shops[0]) > 0){
                    return MapController::Fetch($shops);
                }else {
                    $shops[] = DB::table('shops')->
                    select('shops.id','shops.nom','shops.lat','shops.lng','shops.descriptif','shops.adresse','cities.nom as nomVille','shops.cp','shops.subcategory_id','shops.category_id','subcategories.libelle','shops.created_at','shops.updated_at','shops.deleted_at')->
                    leftJoin('categories', 'categories.id', '=', 'shops.category_id')->
                    leftJoin('subcategories', 'subcategories.id', '=', 'shops.subcategory_id')->
                    leftJoin('cities', 'cities.id', '=', 'shops.city_id')->
                    where('categories.libelle', 'Like','%' . $search . '%')->
                    where('shops.etat', 1)->
                    orderBy('shops.nom')->
                    get();

                    if(count($shops[0]) > 0){
                        return MapController::Fetch($shops);
                    }else {
                        $shops[] = DB::table('shops')->
                        select('shops.id','shops.nom','shops.lat','shops.lng','shops.descriptif','shops.adresse','shops.cp','cities.nom as nomVille','shops.subcategory_id','shops.category_id','subcategories.libelle','shops.created_at','shops.updated_at','shops.deleted_at')->
                        leftJoin('categories', 'categories.id', '=', 'shops.category_id')->
                        leftJoin('subcategories', 'subcategories.id', '=', 'shops.subcategory_id')->
                        leftJoin('cities', 'cities.id', '=', 'shops.city_id')->
                        where('cities.nom', 'Like','%' . $search . '%')->
                        where('shops.etat', 1)->
                        orderBy('shops.nom')->
                        get();

                        return MapController::Fetch($shops);
                    }
                }
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

    static public function post(Request $request){
        //dd($request->input('0'));
        //dd($request->input());

        //if(!$request->filled('message')) return redirect()->back()->with('error', 'You can\'t send an empty message');
        if(isset($request->input('0')['search'])){

            if(empty($request->input('0')['search']) || $request->input('0')['search'] == null) return redirect()->route('Allmap');

            $search = urldecode($request->input('0')['search']);
            /*$search = str_replace("+", " ", $search);
            $search = str_replace("%27", "'", $search);
            $search = str_replace("%2F", "/", $search);
            $search = str_replace("%3F", "?", $search);*/


            $research = MapController::FindSearch($search);

            return json_encode($research);

            /*
            if(empty($request->input('0')['search'])){
                $norEst = ["lat" => 54.29088164657006, "lng" => 26.235351562500004];
                $sudOue = ["lat" => 32.91648534731439, "lng" => -14.106445312500002];
                $cat = ["All"];
                $subCat = ["All"];

                $categories = MapController::FindCat($cat, $subCat, $norEst, $sudOue);

                return json_encode($categories);
            }
            */

        }
        else{

            //dd($request->input('0'));
            $norEst = $request->input('0')['northEast'];
            $sudOue = $request->input('0')['sudOuest'];
            $cat = $request->input('0')['categories'] ?? ["All"];
            $subCat = $request->input('0')['subcategories'] ?? ["All"];

            $categories = MapController::FindCat($cat, $subCat, $norEst, $sudOue);

            //$subCategories = MapController::FindSubCat($subCat,$norEst,$sudOue);
            //dd($subCategories);
            //dd(json_encode($categories));
            return json_encode($categories);
        }

        //dd($search);
        //return view('ajax-request');
    }

    public function store(Request $request){
        $data = $request->all();
        #create or update your data here

        return response()->json(['success' => 'Ajax request submitted successfully']);
    }

    static public function API($laRecherche){

        $query = $laRecherche;
        $curl = curl_init();
        curl_setopt_array(
            $curl,
            [
                CURLOPT_URL => "http://api-adresse.data.gouv.fr/search/?q=". urlencode($query),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_POSTFIELDS => "",
            ]
        );

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            abort(403);
        } else {
            return json_decode($response)->features[0];
        }
    }
}
