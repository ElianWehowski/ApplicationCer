@extends('template1')
@section('contenu')
    <div class="card">
        <header class="card-header">
            <p class="card-header-title">Modification d'une enchère</p>
        </header>
        <div class="card-content">
            <div class="content">
                <form class="form-horizontal" method="POST" action="{{ route('objet.update', $objet->id) }}">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="field">
                        <label class="label">Nom de l'objet</label>
                        <div class="control">
                            <input class="input" id="nom" type="text" name="nom" value="{{ old('nom',$objet->nom) }}" required>
                        </div>
                        @error('nom')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="prix" class="label">Prix de base</label>
                        <div class="control">
                            <input class="input" id="prix" type="numeric" name="prix" value="{{ old('duree',$objet->prix) }}" >
                            @error('prix')
                            <div class="invalid-feedback">Le nombre d'habitants est obligatoire et doit être inferieure à 32768</div>
                            @enderror
                        </div>
                    </div>
                    <div class="select">
                        <div class="control">
                            <select  onchange="window.location.href = this.value">
                                <option value="{{ route('objet.index') }}">Toutes les catégories</option>
                                @foreach($categories as $categorie)
                                    <option value="{{ route('objet.categorie', $categorie->id) }}"
                                        {{ $objet->idCategorie == $categorie->id ? 'selected' : '' }}>{{ ucfirst($categorie->libelle) }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="field">
                        <label for="ouverture" class="label">ouverture</label>
                        <div class="control">
                            <input class="input" id="ouverture" type="datetime-local"  name="ouverture" value="{{ old('unite',$objet->dateOuverture) }}" >
                            @error('ouverture')
                            <div class="invalid-feedback">La superficie est obligatoire et doit faire moins de 2147483645m²</div>
                            @enderror
                        </div>
                    </div>
                    <div class="field">
                        <label for="fermeture" class="label">fermeture</label>
                        <div class="control">
                            <input class="input" id="fermeture" type="datetime-local"  name="fermeture" value="{{ old('unite',$objet->dateFermeture) }}" >
                            @error('fermeture')
                            <div class="invalid-feedback">La superficie est obligatoire et doit faire moins de 2147483645m²</div>
                            @enderror
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <button type="submit" class="button is-link">
                                Enregistrer
                            </button>
                            <a class="button is-info" href="{{ route('objet.index') }}">Retour à la liste</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection
