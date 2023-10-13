@extends('layouts.app')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container">
        <a href="{{ route('manage_categories') }}" class="font-weight-bold my-5">Retour</a>
        <h1 class="mb-3">Ajouter des sous-catégories</h1>
        <div class="card">
            <div class="card-header">{{ $category->libelle }}</div>
            <div class="card-body">
                @forelse($subcategories as $subcategory)
                    <div class="row my-3">
                        <h3 class="col-md-6">{{ $subcategory->libelle }}</h3>
                        <a href="{{ route('get_update_subcategory',
                            [
                                'category_id' => $category->id,
                                'subcategory_id' => $subcategory->id
                            ])
                        }}"
                           class="col-sm-3 col-lg-4 col-md-2 btn btn-primary"
                        >
                            Modifier
                        </a>
                    </div>
                @empty
                    <div class="row my-3">
                        <h3 class="col-md-6">Pas encore de sous-catégories</h3>
                    </div>
                @endforelse

                <h2 class="pt-5 pb-2">Ajouter une sous-catégorie</h2>
                <form method="POST" action="{{ route('post_add_subcategory', ['category_id' => $category->id]) }}">
                    @csrf
                    <label for="name">Nom</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}">
                    <button type="submit" class="btn btn-primary mt-5 d-block">Valider</button>
                </form>
            </div>
        </div>
    </div>
@endsection
