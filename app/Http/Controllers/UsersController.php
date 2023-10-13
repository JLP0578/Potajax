<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Shops\Shop;
use App\Shops\Picture;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$auth = Auth::user();
        $myshops = Shop::with(['pictures', 'moderation'])->where('user_id', $auth->id)->get();
        return view('pages.account', ['auth'=> $auth, 'myshops'=> $myshops]);
    }

    public function updateUser()
    {
        $user = User::findOrFail(Auth::id());
        $manager = $user->role === User::MANAGER;

        return view('pages.update-user', compact('user', 'manager'));
    }

    public function postUpdateUser(Request $request)
    {
        $user = User::findOrFail(Auth::id());
        $tel_is_required = Auth::user()->role === User::MANAGER ? 'required' : '';
        $request->validate([
           'lastname' => ['required', 'string', 'max:255'],
           'firstname' => ['required', 'string', 'max:255'],
           'email' => ['required', 'string', 'email', 'max:255'],
           'tel' => [ $tel_is_required, 'regex:/^\+?[0-9 ]+$/', 'min:10', 'max:14']
        ]);
        $user->nom = $request->lastname;
        $user->prenom = $request->firstname;
        $user->email = $request->email;
        if($request->tel) {
            $user->tel = $request->tel;
        }
        $user->save();
        return redirect()->back()->with('success', 'Modification réussie');
    }
}
