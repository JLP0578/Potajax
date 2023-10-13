<?php

namespace App\Http\Controllers;
// namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    // Les tableaux des providers autorisés
    protected $providers = [ "google", "facebook" ];

    public function socialLogin()
    {
        return view("socialite.social-login");
    }

    /**
     * Redirect the user to the provider authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider(Request $request)
    {
        // On récupère le provider

        $provider = $request->provider;

        // Si le provider est autorisé

        if(in_array($provider, $this->providers))
        {
            // On redirige l'utilisateur desus

            return Socialite::driver($provider)->redirect();
        }

        // Sinon, 404
        else abort(404);
    }

    /**
     * Obtain the user information from provider.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(Request $request)
    {
        // On récupère le provider

        $provider = $request->provider;

        if (in_array($provider, $this->providers))
        {
        	// Les informations provenant du provider

            $userData = Socialite::driver($request->provider)->user();

            if($provider == "Facebook")
            {
                $userName = $userData->offsetGet('first_name');
                $userLastName = $userData->offsetGet('last_name');
            }

            else
            {
                $userName = $userData->offsetGet('given_name');
                $userLastName = $userData->offsetGet('family_name');
            }

            // Enregistrement Social Login

            $userEmail = $userData->getEmail(); // Récup de l'e-mail
            $userName = $userData->getName(); // Récup du nom

            // On récupère l'utilisateur en fonction de l'adresse mail

            $user = User::where("email", $email)->first();

            // Si l'utilisateur existe

            if(isset($user))
            {
                // On met ses informations à jour dans la BDD

                $user->name = $userName;
                $user->save();
            }

            // Si l'utilisateur n'existe pas, on enregistre ses infos en BDD

            else
            {
                // Enregistrement de l'utilisateur

                $user = User::create([
                    'first_name' => $userName,
                    'last_name' => $userLastName,
                    'email' => $userEmail,
                    'password' => bcrypt("michelgegelesang") // On attribue un mot de passe par défaut
                ]);
            }

            // Ensuite, on connecte l'utilisateur

            auth()->login($user);

            // Redirection de l'utilisateur sur la page d'accueil après sa connexion

            if(auth()->check())
            {
                return redirect(route('home'));
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

        else abort(404);
    }
}
