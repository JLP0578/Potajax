@extends("layouts.app")

@section("content")

<div class="container">
	<h1> Se connecter avec Google </h1>
	<p>
		<!-- Lien de redirection vers Google -->
		<a href="{{ route('socialite.redirect', 'google') }}" title="Connexion/Inscription avec Google" class="btn btn-link"> Continuer avec Google </a>

		<!-- Lien de redirection vers Google -->
		<a href="{{ route('socialite.manager', 'google') }}" title="Connexion/Inscription avec Google" class="btn btn-link"> Continuer en tant que commerçant avec Google </a>
	</p>
</div>

@endsection