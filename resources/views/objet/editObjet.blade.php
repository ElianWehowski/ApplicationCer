@extends('template1')
@section('contenu')

<?php
$dOuverture = date_create($objet->dateOuverture);
$dOuverture = strtotime($dOuverture->format('Y-m-d\TH:i:s'));
$dFermeture = date_create($objet->dateFermeture);
$dFermeture = strtotime($dFermeture->format('Y-m-d\TH:i:s'));
var_dump($objet);
?>
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
                    <div class="field">
                        <label class="label">Catégorie</label>
                        <div class="control">
                            <select class="select" name="idCategorie">
                                @foreach($categories as $categorie)
                                    <option value="{{ $categorie->id }}" {{ in_array($categorie->id, old('idCategorie') ?: []) ? 'selected' : '' }}>{{ $categorie->libelle }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('categorie')
                        <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field">
                        <label for="dateOuverture" class="label">ouverture</label>
                        <div class="control">
                            <input class="input" id="dateOuverture" type="datetime-local"  name="dateOuverture" value="{{ old('unite',date('Y-m-d\TH:i:s',$dOuverture)) }}" >
                            @error('dateOuverture')
                            <div class="invalid-feedback">La superficie est obligatoire et doit faire moins de 2147483645m²</div>
                            @enderror
                        </div>
                    </div>
                    <div class="field">
                        <label for="dateFermeture" class="label">fermeture</label>
                        <div class="control">
                            <input class="input" id="dateFermeture" type="datetime-local"  name="dateFermeture" value="{{ old('unite',date('Y-m-d\TH:i:s',$dFermeture)) }}" >
                            @error('dateFermeture')
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
