<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function get(Request $request){

        $search = $request->input('search');
        //dd($search);
        if (isset($search) && !empty($search)) {
            $resultat = SearchController::Find($search);

            switch ($resultat['type']) {
                case 'shops':
                    SearchController::Centroide($resultat['resultat'], $resultat['type']);
                    break;
                case 'categories.id':
                    return redirect()->route('Catmap', ['category_id' => $resultat['resultat']]);
                case 'subcategories.id':
                    return redirect()->route('Subcatmap', ['category_id' => $resultat['resultat'][0],'subcategory_id' => $resultat['resultat'][1]]);
                case 'adress':
                    SearchController::Centroide($resultat['resultat'], $resultat['type']);
                    break;
            }
        }

        /*return view('pages.search', [
            'resultat' => $resultat
        ]);*/
    }
    public function Find($laRecherche){
        $res = null;
        //$laRecherche = "Royce Smith DDS";

        //nom shop
        $resultat = DB::table('shops')->
        where('shops.nom', 'Like', $laRecherche.'%')->get();

        if (empty($resultat[0])) {
            // nom categorie
            $resultat = DB::table('categories')->
            where('categories.libelle', 'Like', $laRecherche.'%')->get();

            if (empty($resultat[0])) {
                // nom subcategorie
                $resultat = DB::table('subcategories')->
                where('subcategories.libelle', 'Like', $laRecherche.'%')->get();

                if (empty($resultat[0])) {
                    // recherche adresse
                    $resultat = SearchController::API($laRecherche);
                    return [
                        'resultat' => $resultat,
                        'type' => 'adress'
                    ];
                }
                return [
                    'resultat' => [$resultat[0]->id,$resultat[0]->category_id],
                    'type' => 'subcategories.id'
                ];
            }
            return [
                'resultat' => $resultat[0]->id,
                'type' => 'categories.id'
            ];
        }
        return [
            'resultat' => $resultat,
            'type' => 'shops'
        ];
    }
    public function API($laRecherche){

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
    static function Centroide($tab, $type){
        $lat = 0.0;
        $lon = 0.0;
        $centerlat = 0;
        $centerlng = 0;

        $shop = MapController::deuxFetch($tab);

        dd($shop);
        //return redirect()->route('Findmap', ['shop' => $shop]);


        /*
        switch ($type) {
            case 'shops':
                foreach ($tab as $value){
                    $lat += $value->lat;
                    $lon += $value->lng;
                }
                $centerlat = $lat / count($tab);
                $centerlng = $lon / count($tab);
                //dd($tab[0]->lat.' '.$tab[0]->lng.' // '.$tab[1]->lat.' '.$tab[1]->lng.' // '.$centerlat.' '.$centerlng);
                break;
            case 'adress':
                foreach ($tab as $value){
                    $lat += $value->lat;
                    $lon += $value->lng;
                }
                $centerlat = $lat / count($tab);
                $centerlng = $lon / count($tab);
                break;
        }
*/
    }

}
