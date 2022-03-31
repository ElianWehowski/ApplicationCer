@extends('template1')
@section('contenu')

    <div class="card">
        <div class="card-content">
            <div class="content">
                <form action="{{ route('categorie.store') }}" method="POST">
                    @csrf
                    <div class="field">
                        <label class="label">Libelle de la categorie</label>
                        <div class="control">
                            <input class="input" type="text" name="libelle" value="{{ old('libelle') }}">
                            @if(isset($erreur))
                                <p class="help is-danger">cette catégorie existe déjà</p><br>
                            @endif
                        </div>
                        @error('libelle')
                        <p class="help is-danger">{{ $message }}</p>
                        @enderror

                        <div class="field">
                            <div class="control">
                                <button class="button is-link">Envoyer</button>

                                <a class="button is-info" href="{{ route('objet.index') }}">Retour à la liste</a>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection
