@extends('template1')
@section('contenu')

    <div class="card">
        <div class="card-content">
            <div class="content">
                <form action="{{ route('categorie.store') }}" method="POST">
                    @csrf
                    <div class="field">
                        <label class="label">Libellé de la categorie</label>
                        <div class="control">
                            <input class="input" type="text" name="libelle" value="{{ old('libelle') }}">
                            @if(isset($erreur))
                                <p class="help is-danger">Cette catégorie existe déjà</p><br>
                            @endif
                        </div>
                        @error('libelle')
                        <p class="help is-danger">{{ $message }}</p>
                        @enderror

                        <div class="field">
                            <div class="control">
                                <br>
                                <button class="button is-link">Créer la catégorie</button>

                                <a class="button is-info" href="{{ route('objet.index') }}">Retour à la liste</a>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection
