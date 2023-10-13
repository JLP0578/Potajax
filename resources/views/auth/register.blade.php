@extends('layouts.app')

@section('content')

<div id="register">
    <div class="container mt-5 register">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-5">
                    <div class="card-header text-center">Inscrivez-vous !</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="lastname" class="col-md-4 col-form-label text-md-right">Nom</label>

                                <div class="col-md-6">
                                    <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>

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
                                    <input id="firstname" type="text" class="form-control @error('Name') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="prenom" autofocus>

                                    @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="role" class="col-form-label text-md-right mr-3">Je suis commerçant</label>
                                    <input type="checkbox" name="role" value="manager" id="role" class="js-manager-button">
                                </div>
                            </div>

                            <div class="js-manager-inputs manager-inputs hidden">
    {{--                            <div class="form-group row">--}}
    {{--                                <label for="adress" class="col-md-4 col-form-label text-md-right">Adresse du commerce</label>--}}
    {{--                                <div class="col-md-6">--}}
    {{--                                    <div class="js-input_container">--}}
    {{--                                        <input id="adress" tabindex="1" type="text" class="form-control js-adress @error('adress') is-invalid @enderror" name="adress" required autocomplete="new-adress" disabled>--}}
    {{--                                        <ul class="js-autocomplete js-hidden">--}}
    {{--                                        </ul>--}}
    {{--                                    </div>--}}
    {{--                                    @error('adress')--}}
    {{--                                    <span class="invalid-feedback" role="alert">--}}
    {{--                                        <strong>{{ $message }}</strong>--}}
    {{--                                    </span>--}}
    {{--                                    @enderror--}}
    {{--                                </div>--}}
    {{--                            </div>--}}

    {{--                            <div class="form-group row">--}}
    {{--                                <label for="street_number" class="col-md-4 col-form-label text-md-right">Numéro de rue</label>--}}
    {{--                                <div class="col-md-6">--}}
    {{--                                    <input id="street_number" tabindex="1" type="text" class="form-control js-street_number @error('street_number') is-invalid @enderror" name="street_number" required autocomplete="new-street_number" disabled>--}}
    {{--                                    @error('street_number')--}}
    {{--                                    <span class="invalid-feedback" role="alert">--}}
    {{--                                        <strong>{{ $message }}</strong>--}}
    {{--                                    </span>--}}
    {{--                                    @enderror--}}
    {{--                                </div>--}}
    {{--                            </div>--}}

    {{--                            <div class="form-group row">--}}
    {{--                                <label for="city" class="col-md-4 col-form-label text-md-right">Ville</label>--}}
    {{--                                <div class="col-md-6">--}}
    {{--                                    <input id="city" tabindex="1" type="text" class="form-control js-city @error('city') is-invalid @enderror" name="city" required autocomplete="new-city" disabled>--}}
    {{--                                    @error('city')--}}
    {{--                                    <span class="invalid-feedback" role="alert">--}}
    {{--                                        <strong>{{ $message }}</strong>--}}
    {{--                                    </span>--}}
    {{--                                    @enderror--}}
    {{--                                </div>--}}
    {{--                            </div>--}}

    {{--                            <div class="form-group row">--}}
    {{--                                <label for="cp" class="col-md-4 col-form-label text-md-right">Code postal</label>--}}
    {{--                                <div class="col-md-6">--}}
    {{--                                    <input id="cp" tabindex="1" type="text" class="form-control js-cp @error('cp') is-invalid @enderror" name="cp" required autocomplete="new-cp" disabled>--}}
    {{--                                    @error('city')--}}
    {{--                                    <span class="invalid-feedback" role="alert">--}}
    {{--                                        <strong>{{ $message }}</strong>--}}
    {{--                                    </span>--}}
    {{--                                    @enderror--}}
    {{--                                </div>--}}
    {{--                            </div>--}}

                                <div class="form-group row">
                                    <label for="tel" class="col-md-4 col-form-label text-md-right">Téléphone</label>
                                    <div class="col-md-6">
                                        <input id="tel" type="tel" class="form-control @error('tel') is-invalid @enderror" name="tel" required autocomplete="new-tel" disabled>
                                        @error('tel')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-success">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
