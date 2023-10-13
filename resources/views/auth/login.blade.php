@extends('layouts.app')

@section('content')

<div class="opacite">
    <div class="card-group">
      
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">{{ __('Login') }}</h5>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="log">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Login') }}
                        </button>
                    </div>
                </div>

                <div class="form-group row mb-0">
                     <div class="col-md-5 offset-md-4">

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </div>

                <div class="form-group row register">
                    <div class="register">
                        Vous n'avez pas de compte ? 
                        <a class="btn btn-success" href="{{ route('register') }}" role="button">Créer un compte</a>
                    </div>

                    <h2 class="ou col-md-8 text-center mt-2 mb-4"> ou </h2>

                    <div class="google d-flex flex-row justify-content-center">
                        <!-- <h1> Se connecter avec Google </h1> -->

                        <!-- Liens de redirection vers Google -->

                        <div class="d-flex flex-column">
                            <label for="user" class="text-center mb-2"> Espace Utilisateur </label>
                            <a href="{{ route('socialite.redirect', 'google') }}"
                               title="Se connecter en tant qu'utilisateur avec Google"
                               class="btn btn-light"
                               name="user">
                                <img src="img/search.png" /> Se connecter avec Google
                            </a>
                        </div>

                        <hr>

                        <div class="d-flex flex-column ml-2">
                            <label for="manager" class="text-center mb-2"> Espace Commerçant </label>
                            <a href="{{ route('socialite.manager', 'google') }}"
                               title="Se connecter en tant que commerçant avec Google"
                               class="btn btn-light"
                               name="manager">
                                <img src="img/search.png" /> Se connecter avec Google
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>

</div>



@endsection
