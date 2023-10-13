<?php

namespace App\Http\Controllers;

use App\Review;
use App\Shops\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function addReview(Request $request, $shop_id)
    {
        $shopCode = Shop::findOrFail($shop_id)->codeNote;

        $request->validate([
            'code' => 'required',
            'note' => 'required|between:0,10',
            'message' => 'required'
        ]);
        if($request->code !== $shopCode) redirect()->back()->withInput()->with('wrong_code', 'Le code n\'est pas valide');

        Review::create([
            'note' => $request->note,
            'message' => $request->message,
            'shop_id' => $shop_id,
            'user_id' => Auth::id()
        ]);

        return redirect()->back()->with('success', 'Ajout de commentaire réussi');
    }

    public function deleteReview($review_id)
    {
        Review::find($review_id)->where('user_id', Auth::id())->delete();
        return redirect()->back();
    }

    public function updateReview(Request $request, $shop_id)
    {
        $request->validate([
           'note' => 'required|between:0,10',
           'message' => 'required'
        ]);

        $review = Review::where('shop_id', $shop_id)->where('user_id', Auth::id())->get()->first();
        $review->message = $request->message;
        $review->note = $request->note;
        $review->save();

        return redirect()->back();
    }
}
