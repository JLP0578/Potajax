<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\User;

class SocialiteManagerController extends Controller
{
    // Les tableaux des providers autorisés

    protected $providers = ["google"];

    public function socialManagerLogin()
    {
        return view("socialite.social-login-manager");
    }

    // Redirige l'utilisateur sur la page de connexion du provider

    public function redirectToProviderManager(Request $request)
    {
        // On récupère le provider

        $provider = $request->provider;

        session(['role' => 2]);

        // Si le provider est autorisé

        if(in_array($provider, $this->providers))
        {
            // On redirige vers le provider

            return Socialite::driver($provider)->redirect();
        }

        // Sinon, 404

        else abort(404);
    }
}
