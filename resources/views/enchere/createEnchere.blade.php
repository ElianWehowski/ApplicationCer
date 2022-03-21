@extends('template1')
@section('contenu')
   <a href="{{route('objet.index')}}"><img src="../images/logoCer.png" width="150px"height="150px" ><br/><br/></a>

    <div class="card">
        <header class="card-header">
            <p class="card-header-title">Création d'une enchère</p>
        </header>
        <div class="card-content">
            <div class="content">
                <form action="{{ route('enchere.store') }}" method="POST">
                    @csrf
                    <div class="field">
                        <label class="label">Nom de l'objet</label>
                        <div class="control">
                            <input class="input" type="numeric" name="nom" value="{{ old('nom') }}">
                        </div>
                        @error('nom')
                        <p class="help is-danger">{{ $message }}</p>
                        @enderror

                    </div>
                    <label class="label" for="categorie">Catégorie</label>
                    <div class="select">
                        <div class="control">
                            <select id="categorie" name="categorie">
                                @foreach($categories as $categorie)
                                    <option value="{{ $categorie->id }}" {{ in_array($categorie->id, old('categorie') ?: []) ? 'selected' : '' }}>{{ $categorie->libelle }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('categorie')
                        <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field">
                        <label class="label">Prix de départ</label>
                        <div class="control">
                            <input class="input" type="numeric" name="prix" value="{{ old('prix') }}">
                        </div>
                        @error('prix')
                        <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field">
                        <label class="label">Date d'ouverture de l'enchère</label>
                        <div class="control">
                            <input class="input" type="datetime-local" name="ouverture" value="{{ old('ouverture') }}">
                        </div>
                        @error('ouverture')
                        <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field">
                        <label class="label">Date de fermeture de l'enchère</label>
                        <div class="control">
                            <input class="input" type="datetime-local" name="fermeture" value="{{ old('fermeture') }}">
                        </div>
                        @error('fermeture')
                        <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>



                    <input type="hidden" name="idProprietaire" value="{{Auth::user()->id}}"></input>
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
