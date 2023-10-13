@extends('layouts.app')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container py-5">
        <a href="{{ route('manage_subcategories', ['category_id' => $category->id]) }}" class="py-5 w-25">Retour</a>
        <div class="card">
            <div class="card-header">Modifier la sous-catégorie {{ $subcategory->libelle }}</div>
            <div class="card-body">
                <form method="POST"
                      action="{{ route('post_update_subcategory', [
                            'category_id' => $category->id,
                            'subcategory_id' => $subcategory->id
                      ]) }}"
                >
                    @csrf
                    <label for="name">Nom</label>
                    <input type="text" name="name" id="name" value="{{ old('name') ?? $subcategory->libelle ?? ''}}">
                    <button type="submit" class="btn btn-primary mt-5 d-block">Valider</button>
                </form>
            </div>
        </div>
    </div>
@endsection

