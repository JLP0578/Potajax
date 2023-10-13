@extends('layouts.app')

@section('content')
    @if(session('success'))
        <div class="alert alert-success m-0">
            {{ session('success') }}
        </div>
    @endif
	<div class="page_map">
        <div class="filters d-flex justify-content mt-4 px-4" id="navig">
        	<div id="btn">
	        	<div class="dropdown mx-2 mt-2">
				  <button class="btn btn-light border-danger dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="true">
				    Catégories
				  </button>
				  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <li><a class="dropdown-item" href="{{ route('Allmap') }}">Tout</a></li>
				  	@foreach($categories as $categorie)
				    	<li><a class="dropdown-item" href="{{ route('Catmap', ['category_id' => $categorie->id]) }}">{{$categorie->libelle}}</a></li>
				    @endforeach
				  </ul>
				</div>

				<div class="dropdown mx-2 mt-2">
				  <button class="btn btn-light border-danger dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="true">
				    Sous catégories
				  </button>
				  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <li><a class="dropdown-item" href="{{ route('Allmap') }}">Tout</a></li>
				  	@foreach($subcategories as $subcategorie)
				    	<li><a class="dropdown-item" href="{{ route('Subcatmap', ['category_id' => $current_category_id,'subcategory_id' => $subcategorie->id]) }}">{{$subcategorie->libelle}}</a></li>
				   	@endforeach
				  </ul>
				</div>
			</div>
            <form class="d-flex" action="{{ route('Recherche') }}">
              <input class="rounded-pill px-2 py-2" type="text" name="search" id="search" placeholder="Rechercher un commerce, une ville...">
              <button class="btn" type="submit"><i class="bi-search"></i></button>
            </form>
        </div>

		 <div class="row">
		    <div class="col-lg-9" id="map">
		    	map
		    </div>
		    <div class="col" id="liste">
				  <div class="card-header">
                      {{ $current_category_lib }}<br>
                      {{ $current_subcategory_lib }}
				  </div>
				  <div class="card-body">
				  	<div class="panel panel-primary" id="result_panel">
					    <div class="panel-body">
					        <ul class="list-group" id="listRightShop">

					        </ul>
                        @foreach($shops as $shop)
                            <!--<li class="list-group-item">
					            	<strong><a href="#">{{$shop->nom}}</a></strong>

					            	<p>{{$shop->adresse}}</p>
					            	<a class="btn btn-outline-danger btn-sm" href="{{ route('shop', ['id' => $shop->id]) }}" role="button">Voir la page</a>
					            </li>-->
                            @endforeach
					    </div>
					</div>
				  </div>

		    </div>
		 </div>

    </div>




@endsection
