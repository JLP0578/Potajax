<form method="POST"
      action="{{
        $update ? route('update_review', ['shop_id' => $infos->id])
            : route('add_review', ['shop_id' => $infos->id])
      }}"
      class="py-3"
>
    @csrf
    @if($input_code)
        <div class="form-group">
            <label for="code" class="mb-2 form-label text-md-right">Code d'ajout</label>
            <p class="py-2 font-weight-bold">Veuilez demander ce code au magasin</p>
            <input type="text"
                   class="form-control w-100 @if(Session::has('wrong_code')) is-invalid @endif"
                   name="code"
                   id="code"
                   value="{{ old('code') }}"
            >
            @if(Session::has('wrong_code'))
                <span class="invalid-feedback" role="alert">
                    <strong>Le code n'est pas valide</strong>
                </span>
            @endif
        </div>
    @endif

    <div class="form-group">
        <label for="note" class="mb-2 form-label text-md-right">Note (sur 10)</label>
        <input type="number"
               max="10"
               min="0"
               class="form-control w-100 @error('note') is-invalid @enderror"
               name="note"
               id="note"
               value="{{ old('note') }}"
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
        >{{ old('message') }}</textarea>
        @error('message')
        <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary m-auto d-block">Valider</button>
</form>
