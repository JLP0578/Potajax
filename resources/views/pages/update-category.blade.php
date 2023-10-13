@extends('layouts.app')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container py-5">
        <a href="{{ route('manage_categories') }}" class="py-5 w-25">Retour</a>
        <div class="card">
            <div class="card-header">Modifier la catégorie {{ $category->libelle }}</div>
            <div class="card-body">
                <form method="POST"
                      action="{{ route('post_update_category', ['category_id' => $category->id]) }}"
                      enctype="multipart/form-data"
                >
                    @csrf
                    <label for="name">Nom</label>
                    <input type="text" name="name" id="name" value="{{ old('name') ?? $category->libelle ?? ''}}">
                    <div class="row">
                        <div class="col-md-6">

                            <label for="image">Image</label>
                            <input id="image"
                                   type="file"
                                   accept="image/*"
                                   class="form-control js-input-picture @error('image') is-invalid @enderror"
                                   name="image"
                            >
                            @error('image')
                            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-5 d-block">Valider</button>
                </form>
            </div>
        </div>
    </div>
@endsection

