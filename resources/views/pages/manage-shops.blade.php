@extends('layouts.app')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container">
        <h1 class="mb-3">Liste des commerces en attente de validation</h1>
        <div class="row">
            @forelse($shops as $shop)
                <div class="card col-md-4 px-0 mx-3 mb-4">
                    <div class="card-header">
                        <h2>{{ $shop->nom }}</h2>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('get_update_shop', [ 'shop_id' => $shop->id]) }}"
                           class="d-block text-center"
                        >
                            Voir les informations
                        </a>
                    </div>
                </div>
            @empty
                <h3>Aucun</h3>
            @endforelse
        </div>
    </div>
@endsection
