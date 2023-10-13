<?php

namespace App\Http\Controllers;

use App\Review;
use App\User;
use Illuminate\Http\Request;
use App\Shops\Shop;
use App\Shops\Visit;
use App\Shops\Categorie;
use App\Shops\Picture;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function details($id){
        $user_id = Auth::id();
    	$infos = Shop::findOrFail($id);
    	$id_cat = $infos->category_id;
    	$img_cat = Categorie::findOrFail($id_cat)->libelle;
    	$average_note = Review::where('shop_id', $id)->avg('note');
    	$average_note = round($average_note, 2);
    	if($user_id) {
            $reviews = Review::where('shop_id', $infos->id)->whereNotIn('user_id', [$user_id])->paginate(5);
        } else {
            $reviews = Review::where('shop_id', $infos->id)->paginate(5);
        }
    	$user_review = Review::where('user_id', $user_id)->get()->first();
    	$user_can_review =
            Review::where('user_id', $user_id)->count() > 0
            || !Auth::check()
            || Auth::user()->role == User::MANAGER
                ? false
                : true;


        $pic = Picture::where('shop_id', $id)->get();
        $visit = Visit::create(['shop_id' => $id]);
    	return view('pages.shop', [
            'infos'=> $infos,
            'pic' => $pic,
            'img'=> $img_cat,
            'user_can_review' => $user_can_review,
            'reviews' => $reviews,
            'average_note' => $average_note,
            'user_review' => $user_review
        ]);
    }
}
