@extends('layouts.app')

@section('admin_scripts')
<script src="//cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
@endsection

@section('content')
    @if(count($pic) == 0)
        <div class="name" style="background: linear-gradient(to bottom right, #eb0000 20%, #ff9500 100%);">
    @else
        <div class="name" style="background-image:url('{{ $pic[0]->url }}');">
    @endif
        <div>
            <a id="back" type="button" class="btn btn-outline-danger btn-circle" href="{{ route('Allmap') }}"><</a>
            <h2 class="title">{{ $infos->nom }}</h2>
            <p class="adresse">Adresse: {{$infos->adresse }} - {{$infos->city->nom ?? ''}} ({{$infos->cp ?? ''}})</p>
            <p class="tel">Téléphone: {{$infos->prefixeTel}} {{$infos->tel}}</p>
            <p class="mail">Email: {{$infos->email}}</p>

            @if(isset($infos->subcategory->libelle))
            <p class="tel">{{$infos->category->libelle}} {{$infos->subcategory->libelle}}</p>
            @else
            <p class="tel">catégorie: {{$infos->category->libelle}}</p>
            @endif

            <a class="btn btn-outline-warning btn-sm fav" href="#" role="button" data-id="{{ $infos->id }}" id="favorite">
                Ajouter aux favoris
            </a>

        </div>
    </div>
    <div class="horaires">
        <p> Horaires: {{$infos->horaires}}</p>
    </div>
    <div class="descriptif">
        <div class="contenu_desc">
            {!!$infos->descriptif!!}
        </div>
    </div>
    <div class="img">
    @foreach($pic as $p)
        <div class="card" style="width: 18rem;">
            <img src="{{ $p->url }}" class="card-img-top my-auto" alt="mon shop">
        </div>
    @endforeach
    </div>

    <div class="container col-md-6 col-sm-12">
        @if($average_note)
            <h3 class="my-5">Moyenne: <strong>{{ $average_note }}/10</strong></h3>
        @endif

        @logged
            @if($user_can_review)
                <button class="btn btn-primary py-3 my-4 d-block mx-auto js-add-review-button">Ajouter un avis</button>
                <div class="card mb-5 mt-1 js-add-review-form">
                    <div class="card-body px-4 py-0">
                        @include('layouts.partials.review_form', ['input_code' => true, 'update' => false])
                    </div>
                </div>
            @endif
        @endlogged

        @if($user_review)
            <div class="card my-5 border-primary pb-3">
                <div class="card card-header flex-row justify-content-between">
                    <h4>Vous</h4>
                    <form method="POST" action="{{ route('delete_review', ['review_id' => $user_review->id]) }}">
                        @csrf
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </div>
                <div class="card-body">
                    <p class="pb-3">{{ $user_review->message }}</p>
                    <p class="font-weight-bold">Note: {{ $user_review->note }}/10</p>
                </div>
                @if(!$user_can_review)
                    <div class="col-md-10 d-block m-auto">
                        <button class="btn btn-primary d-block m-auto my-3 js-update-review-button">Modifier</button>
                        <form method="POST"
                              action="{{ route('update_review', ['shop_id'=> $infos->id]) }}"
                              class="js-update-review-form"
                        >
                            @csrf
                            <div class="form-group">
                                <label for="note" class="mb-2 form-label text-md-right">Note (sur 10)</label>
                                <input type="number"
                                       max="10"
                                       min="0"
                                       class="form-control w-100 @error('note') is-invalid @enderror"
                                       name="note"
                                       id="note"
                                       value="{{ old('note') ?? $user_review->note  }}"
                                >
                                @error('note')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="message" class="mb-2 form-label text-md-right">Message</label>
                                <textarea name="message"
                                          class="w-100 d-block p-3 @error('message') is-invalid @enderror"
                                          id="message"
                                          cols="30"
                                          rows="10"
                                >{{ old('message') ?? $user_review->message}}</textarea>
                                @error('message')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <button class="btn btn-primary d-block m-auto" type="submit">Valider</button>
                        </form>
                    </div>
                @endif
            </div>
        @endif

        @forelse($reviews as $review)
            <div class="card my-3">
                <div class="card card-header">
                    <h4>{{ $review->user->prenom }}</h4>
                </div>
                <div class="card-body">
                    <p class="pb-3">{{ $review->message }}</p>
                    <p class="font-weight-bold">Note: {{ $review->note }}/10</p>
                </div>
            </div>
        @empty
            @if(!$user_review)
                <p class="text-center my-5">Pas encore d'avis sur ce magasin</p>
            @endif
        @endforelse

        @if($reviews)
            {{ $reviews->links() }}
        @endif

    </div>

    @moderator
        <h3 class="text-center mt-5">Invalider le commerce</h3>
        <div class="container">
            <form method="POST"
                  action="{{ route('reject_shop', ['shop_id' => $infos->id]) }}"
                  class="col-md-6 m-auto"
            >
                @csrf

                <label for="motifRefus">Message de refus: </label>
                <textarea class="form-control @error('motifRefus') is-invalid @enderror"
                          id="motifRefus"
                          name="motifRefus"
                ></textarea>
                @error('motifRefus')
                <span class="invalid-feedback" role="alert">
                    <strong>Le champ d'explication du refus est requis</strong>
                </span>
                @enderror
                <br/>
                <button type="submit" class="btn btn-danger">
                    Refuser
                </button>
            </form>
        </div>
    @endmoderator
@endsection
