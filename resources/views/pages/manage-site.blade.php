@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Gérer les données du site</h1>
        <a href="{{ route('manage_categories') }}" class="btn btn-primary my-5 mr-3">Gérer les catégories / sous-catégories</a>
    </div>
@endsection
