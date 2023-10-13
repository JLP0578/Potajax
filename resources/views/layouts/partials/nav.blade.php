<nav class="navbar navbar-expand-xl navbar-light bg-white shadow-sm">
{{--    <div class="container">--}}
        <a class="navbar-brand navbar-brand-logo" href="{{ url('/') }}" title="Vers la page d'accueil">
            <div class="logo"><img src="{{ asset('img/Fichier_8.svg') }}" alt="Vers la page d'accueil" width="30" height="auto" class="d-inline-block align-top"></div>
            <div class="brand">Ramène Ta Fraise</div>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest --->
                <li class="nav-item" >
                    <a class="nav-link" href="{{ route('Allmap') }}" title="Vers la map">
                        <div id="fav">Map</div>
                        <div id="imfav"><img src="{{ asset('img/map.svg') }}" alt="Vers la map" width="30" height="auto" class="d-inline-block align-top"></div>
                    </a>
                </li>

                <li class="nav-item" >
                    <a class="nav-link" href="{{ route('favorites') }}" title="Vers les favoris">
                        <div id="fav">Favoris</div>
                        <div id="imfav"><img src="{{ asset('img/star.svg') }}" alt="Vers les favoris" width="30" height="auto" class="d-inline-block align-top"></div>
                    </a>
                </li>

                @if(Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('account') }}" title="Vers le compte utilisateur">
                            <div id="user">Mon compte</div>
                            <div><img src="{{ asset('img/user.svg') }}" alt="Vers le compte utilisateur" width="30" height="auto" class="d-inline-block align-top"></div>
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('account') }}" title="Vers la connexion et/ou l'inscription">
                            <div id="user">Connexion/Inscription</div>
                            <div><img src="{{ asset('img/user.svg') }}" alt="Vers la connexion et/ou l'inscription" width="30" height="auto" class="d-inline-block align-top"></div>
                        </a>
                    </li>
                @endif

                @admin
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('manage_site') }}" title="Vers la zone de gestion">
                            <div>Gérer les données</div>
                            <div><img src="{{ asset('img/database.svg') }}" alt="Vers la zone de gestion" width="30" height="auto" class="d-inline-block align-top"></div>
                        </a>
                    </li>
                @endadmin

                @moderator
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('manage_shops') }}" title="Vers la zone de gestion des commerces">
                            <div>Gérer les commerces</div>
                            <div><img src="{{ asset('img/shops.svg') }}" alt="commerces" width="30" height="auto" class="d-inline-block align-top"></div>
                        </a>
                    </li>
                @endmoderator
            </ul>
        </div>
{{--    </div>--}}
</nav>
