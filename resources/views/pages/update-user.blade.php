@extends('layouts.app')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container pt-5">
        <a href="{{ route('account') }}" class="font-weight-bold my-5">Retour</a>
        <div class="card">
            <div class="card-header">Modifier mes informations</div>
            <div class="card-body">
                <form action="{{ route('post_update_user') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="lastname" class="col-md-4 col-form-label text-md-right">Nom</label>
                        <div class="col-md-6">
                            <input type="text"
                                   class="@error('lastname') is-invalid @enderror"
                                   name="lastname"
                                   id="lastname"
                                   value="{{ old('lastname') ?? $user->nom }}"
                                   required
                            >
                            @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="firstname" class="col-md-4 col-form-label text-md-right">Prénom</label>
                        <div class="col-md-6">
                            <input type="text"
                                   class="@error('firstname') is-invalid @enderror"
                                   name="firstname"
                                   id="firstname"
                                   value="{{ old('firstname') ?? $user->prenom }}"
                                   required
                            >
                            @error('firstname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">Adresse email</label>
                        <div class="col-md-6">
                            <input type="email"
                                   class="@error('email') is-invalid @enderror"
                                   name="email"
                                   id="email"
                                   value="{{ old('email') ?? $user->email }}"
                                   required
                            >
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    @if($manager)
                        <div class="form-group row">
                            <label for="tel" class="col-md-4 col-form-label text-md-right">Téléphone</label>
                            <div class="col-md-6">
                                <input type="tel"
                                       class="@error('tel') is-invalid @enderror"
                                       name="tel"
                                       id="tel"
                                       value="{{ old('tel') ?? $user->tel }}"
                                       required
                                >
                                @error('tel')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    @endif
                    <button type="submit" class="btn btn-primary m-auto d-block">Valider</button>
                </form>
            </div>
        </div>
    </div>

@endsection
