<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\User;

class SocialiteController extends Controller
{
    // Les tableaux des providers autorisés

    protected $providers = ["google"];

    public function socialLogin()
    {
        return view("socialite.social-login");
    }

    // Redirige l'utilisateur sur la page de connexion du provider

    public function redirectToProvider(Request $request)
    {
        // On récupère le provider

        $provider = $request->provider;

        // Si le provider est autorisé

        if(in_array($provider, $this->providers))
        {
            // On redirige vers le provider

            return Socialite::driver($provider)->redirect();
        }

        // Sinon, 404

        else abort(404);
    }

    // Obtention des informations de l'utilisateur via le provider

    public function handleProviderCallback(Request $request)
    {
        // On récupère le provider

        $provider = $request->provider;

        if(in_array($provider, $this->providers))
        {
        	// Les informations provenant du provider

            $userData = Socialite::driver($request->provider)->user();

            $userName = $userData->offsetGet('given_name');
            $userLastName = $userData->offsetGet('family_name');

            // Split du nom et prénom de l'utilisateur pour récupérer uniquement le prénom par la suite

            $userExplode = explode(" ", $userName);

            // Prénom de l'utilisateur

            $userFirstname = $userExplode[0];

            // Enregistrement Social Login

            $userEmail = $userData->getEmail(); // Récup de l'e-mail
            $userName = $userData->getName(); // Récup du prénom

            // On récupère l'utilisateur en fonction de l'adresse mail

            $user = User::where("email", $userEmail)->first();

            // Si l'utilisateur existe

            if(isset($user))
            {
                // On met ses informations à jour dans la BDD

                $user->nom = $userLastName;
                $user->save();
            }

            // Si l'utilisateur n'existe pas, on enregistre ses infos en BDD
                 
            else
            {
                // On assigne à role la valeur de la variable de session nommée role, si elle est null on assigne false

                $role = session('role')??1;

                // Condition ternaire

                $roleUser = $role == User::MANAGER ? User::MANAGER : User::USER;

                // Enregistrement de l'utilisateur

                $user = User::create([
                    'nom' => $userLastName,
                    'prenom' => $userFirstname,
                    'email' => $userEmail,
                    'password' => bcrypt("michelgegelesang"), // On attribue un mot de passe par défaut
                    'role' => $role,
                ]);
            }

            // Ensuite, on connecte l'utilisateur

            auth()->login($user);

            // Redirection de l'utilisateur sur la page d'accueil après sa connexion

            if(auth()->check())
            {
                return redirect(route('index'));
            }

            else abort(404);

            // On récupère les informations de l'utilisateur

            /*$user = $userData->user;
            $userToken = $userData->token;
            $userId = $userData->getId();
            $userName = $userData->getName();
            $userNickname = $userData->getNickname();
            $userEmail = $userData->getEmail();
            $userAvatar = $userData->getAvatar();*/

            dd($user);
        }

        else abort(403);
    }
}
