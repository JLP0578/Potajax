@extends('layouts.app')

@section('admin_scripts')
    <script src="//cdn.ckeditor.com/4.16.0/standard/ckeditor.js" defer></script>
@endsection

@section('content')
    <div class="container mt-5 register">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Ajouter un commerce</div>
                    <div class="card-body">
                        <form method="POST"
                              action="{{ route('post_add_update_shop', ['id' => isset($shop->id) ? $shop->id : null]) }}"
                              enctype="multipart/form-data"
                        >
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>
                                <div class="col-md-6">
                                    <input id="name"
                                           type="text"
                                           class="form-control @error('name') is-invalid @enderror"
                                           name="name"
                                           required
                                           autocomplete="new-name"
                                           value="{{ old('name') ?? $shop->nom ?? '' }}"
                                    >
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('Catégorie') }}</label>
                                <div class="col-md-6">
                                    <select name="category" id="category" class="js-category">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}"
                                                @if(isset($shop))
                                                    {{ $shop->category->id === $category->id ? 'selected' : '' }}
                                                @endif
                                            >
                                                {{ $category->libelle }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <label for="subcategory" class="col-md-4 col-form-label text-md-right">{{ __('Sous-Catégorie') }}</label>
                                <div class="col-md-6">
                                    <select name="subcategory" id="subcategory" class="js-subcategory">
                                        <option value="-1">--Optionel--</option>
                                        @if(isset($shop))
                                            @foreach($shop->category->subCategories as $subCategory)
                                                <option
                                                    value="{{ $subCategory->id }}"
                                                    @if($shop->subCategory)
                                                        {{$shop->subCategory->id === $subCategory->id ? 'selected' : ''}}
                                                    @endif
                                                >
                                                    {{ $subCategory->libelle }}
                                                </option>
                                            @endforeach
                                        @else
                                            @foreach($categories[0]->subCategories as $subCategory)
                                                <option value="{{ $subCategory->id }}">
                                                    {{ $subCategory->libelle }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>


                            <div class="form-group row">

                                @if(isset($shop->pictures))
                                <table class="table">
                                    <tbody>
                                        @foreach($shop->pictures as $picture)
                                        <tr data-picture="{{ $picture->id }}">
                                            <td align="center"><img src="{{$picture->url}}" alt="" width="100" ></td>
                                            <td align="center"><button class="btn btn-primary" data-picture="{{ $picture->id }}">Supprimer</button></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @endif
                                <div class="col-sm-12  my-4 alert alert-danger js-max-pictures" style="display: none">
                                    <strong>Le nombre maximum d'images par magasin est de 4</strong>
                                </div>
                                <label for="images" class="col-md-4 col-form-label text-md-right">{{ __('Images') }}</label>
                                <div class="col-md-6">
                                    <input id="images"
                                           type="file"
                                           multiple="multiple"
                                           accept="image/*"
                                           class="form-control js-input-picture @error('images') is-invalid @enderror"
                                           name="images[]"
                                    >
                                    @error('images')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                @if(Session::has('too_much_files'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>$message</strong>
                                    </span>
                                @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-md-2 col-form-label text-md-right">{{ __('Description') }}</label>
                                <div class="col-md-10">
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                              id="summary-ckeditor"
                                              name="description"
                                              data-content="{{ old('description') ?? $shop->descriptif ?? '' }}"></textarea>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Le champ description est requis</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tel" class="col-md-4 col-form-label text-md-right">{{ __('Téléphone') }}</label>
                                <div class="col-md-6">
                                    <input id="tel"
                                           type="tel"
                                           class="form-control @error('tel') is-invalid @enderror"
                                           name="tel"
                                           required
                                           max="14"
                                           autocomplete="new-tel"
                                           value="{{ old('tel') ?? $shop->tel ?? '' }}"
                                    >
                                    @error('tel')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                                <div class="col-md-6">
                                    <input id="email"
                                           type="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           name="email"
                                           required
                                           autocomplete="new-email"
                                           value="{{ old('email') ?? $shop->email ?? '' }}"
                                    >
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="siret" class="col-md-4 col-form-label text-md-right">{{ __('Siret') }}</label>
                                <div class="col-md-6">
                                    <input id="siret"
                                           type="text"
                                           maxlength="16"
                                           class="form-control @error('siret') is-invalid @enderror"
                                           name="siret"
                                           required
                                           autocomplete="new-siret"
                                           value="{{ old('siret') ?? $shop->siret ?? '' }}"
                                    >
                                    @error('siret')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="hours" class="col-md-4 col-form-label text-md-right">{{ __('Horaires') }}</label>
                                <div class="col-md-6">
                                    <textarea name="hours" id="" rows="8" class="form-control">{{ old('hours') ?? $shop->horaires ?? '
- Lundi:
- Mardi:
- Mercredi:
- Jeudi:
- Vendredi:
- Samedi:
- Dimanche:
' }}

                                    </textarea>
                                    @error('hours')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="adress" class="col-md-4 col-form-label text-md-right">Adresse</label>
                                <div class="col-md-6">
                                    <div class="js-input_container">
                                        <input id="adress"
                                               type="text"
                                               class="form-control js-adress @error('adress') is-invalid @enderror"
                                               name="adress"
                                               required
                                               autocomplete="off"
                                               value="{{ old('adress') ?? $shop->adresse ?? '' }}"
                                        >
                                        <ul class="js-autocomplete js-hidden">
                                        </ul>
                                    </div>
                                    @error('adress')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="adress2" class="col-md-4 col-form-label text-md-right">Adresse ligne 2</label>
                                <div class="col-md-6">
                                    <input id="adress2"
                                           tabindex="1"
                                           type="text"
                                           class="form-control @error('adress2') is-invalid @enderror"
                                           name="adress2"
                                           autocomplete="new-adress2"
                                           value="{{ old('adress2') ?? $shop->adress2 ?? '' }}"
                                    >
                                    @error('adress2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="street_number" class="col-md-4 col-form-label text-md-right">Numéro de rue</label>
                                <div class="col-md-6">
                                    <input id="street_number"
                                           type="text"
                                           class="form-control js-street_number @error('street_number') is-invalid @enderror"
                                           name="street_number"
                                           autocomplete="new-street_number"
                                           value="{{ old('street_number') ?? $shop->numRue ?? '' }}"
                                    >
                                    @error('street_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="city" class="col-md-4 col-form-label text-md-right">Ville</label>
                                <div class="col-md-6">
                                    <input id="city"
                                           type="text"
                                           class="form-control js-city @error('city') is-invalid @enderror"
                                           name="city"
                                           required
                                           autocomplete="new-city"
                                           value="{{ old('city') ?? $shop->city->nom ?? '' }}"
                                    >
                                    @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="cp" class="col-md-4 col-form-label text-md-right">Code postal</label>
                                <div class="col-md-6">
                                    <input id="cp"
                                           type="text"
                                           class="form-control js-cp @error('cp') is-invalid @enderror"
                                           name="cp"
                                           required
                                           autocomplete="new-cp"
                                           value="{{ old('cp') ?? $shop->cp ?? '' }}"
                                    >
                                    @error('cp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <input type="hidden" class="js-lat" name="lat" value="{{ $city->lat ?? old('lat') ?? ''}}">
                            <input type="hidden" class="js-lng" name="lng" value="{{ $city->lng  ?? old('lng') ?? ''}}">
                            <input type="hidden" class="js-citycode" name="citycode" value="{{ $city->id ?? old('citycode') ?? ''}}">

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Valider</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
