@extends('layouts.app')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container py-5">
        <a href="{{ route('manage_shops') }}" class="py-5 w-25">Retour</a>
        <div class="card">
            <div class="card-header">Information du commerce <strong>{{ $shop->nom }}</strong></div>
            <div class="card-body">

                <strong>Nom:</strong> {{ $shop->nom ?? ''}}<br/>

                <strong>Adresse:</strong> {{ $shop->adresse ?? ''}}<br/>
                <strong>Adresse 2:</strong> {{ $shop->adresse2 ?? ''}}<br/>
                <strong>Code postal:</strong> {{ $shop->cp ?? ''}}<br/>
                <strong>n° Rue:</strong> {{ $shop->numRue ?? ''}}<br/>

                <strong>Latitude:</strong> {{ $shop->lat ?? ''}}<br/>
                <strong>Longitude:</strong> {{ $shop->lng ?? ''}}<br/>

                <strong>Prefix téléphone:</strong> {{ $shop->prefixeTel ?? ''}}<br/>
                <strong>Téléphone:</strong> {{ $shop->tel ?? ''}}<br/>

                <strong>Email:</strong> {{ $shop->email ?? ''}}<br/>
                <strong>SIRET:</strong> {{ $shop->siret ?? ''}}<br/>
                <strong>codeNote:</strong> {{ $shop->codeNote ?? ''}}<br/>

                <strong>Ville:</strong> {{ $shop->city->nom ?? ''}}<br/>
                <strong>Utilisateur:</strong> {{ $shop->user->nom ?? ''}} {{ $shop->user->prenom ?? ''}}<br/>
                <strong>Catégorie:</strong> {{ $shop->category->libelle ?? ''}}<br/>
                <strong>Sous-catégorie:</strong> {{ $shop->subCategory->libelle ?? ''}}<br/>
                <strong>Descriptif:</strong><br>
                <div class="my-3 p-2 border">
                    {!! $shop->descriptif ?? '' !!}
                </div>
                <strong>Horaires:</strong><br>
                <div class="my-3 p-2 border">{{ $shop->horaires }}</div>
                <strong class="mr-3">images:</strong>
                <div class="border py-3 flex-row justify-content-start flex-wrap align-items-center">
                    @forelse($shop->pictures as $pic)
                        <img src="{{ $pic->url }}"
                             title="image {{ $pic->shop_id }}_{{ $pic->id }}"
                             width="150"
                             class="mx-3"
                        >
                    @empty
                        <strong>aucune image</strong>
                    @endforelse
                </div>

                <hr>

                <form method="POST"
                      action="{{ route('validate_shop', ['shop_id' => $shop->id]) }}"
                      >
                    @csrf

                    <label for="motifRefus">Message de refus: </label>
                    <textarea class="form-control @error('motifRefus') is-invalid @enderror"
                              id="motifRefus"
                              name="motifRefus"
                              data-content="{{ old('motifRefus') ?? $shop->motifRefus ?? '' }}"
                    ></textarea>
                    @error('motifRefus')
                    <span class="invalid-feedback" role="alert">
                        <strong>Le champ d'explication du refus est requis</strong>
                    </span>
                    @enderror
                    <br/>

                    <button type="submit" class="btn btn-success mr-3">Valider</button>
                    <button type="submit"
                            class="btn btn-danger"
                            formaction="{{ route('reject_shop', ['shop_id' => $shop->id]) }}"
                    >
                        Refuser
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

