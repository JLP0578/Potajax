@extends('layouts.app')


@section('content')
    <div class="home">
        @if($auth != null)
            <div class="auth text-center">
                Bonjour {{ $auth->prenom }} !
            </div>
        @endif
        <div class="intro px-3">
            <form class="d-flex" action="{{ route('Recherche') }}">
              <input class="rounded-pill px-3 py-3" type="text" name="search" id="search" placeholder="Rechercher un commerce, une ville...">
              <button class="btn" type="submit"><i class="bi-search" style="font-size: 2rem; color: white;"></i></button>
            </form>


            <div>
                <h1 class="h1">Consommez mieux, consommez local</h1>
                <h2 class="h2">Découvrez les commerces en click & drive près de chez vous</h2>
            </div>
        </div>

        <div class="filters d-flex justify-content-around mt-5 px-5" id="cat">


            @foreach($categories as $categorie)
                <a href="{{ route('Catmap', ['category_id' => $categorie->id]) }}" class="lien_cat">
                    <div class="d-flex align-items-center flex-column">

                            <div id="zoom" class="rounded-circle bg-secondary category_image mb-3 mx-3"
                             style="background-image:url('img/Size_Small/{{$categorie->libelle}}.jpg');"></div>
                            <h3 class="text-dark" style="font-size:17px;">{{ $categorie->libelle }}</h3>

                    </div>
                </a>

            @endforeach
        </div>

    </div>

@endsection
