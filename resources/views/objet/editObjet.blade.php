@extends('template1')
@section('contenu')
<div class="card">
    <header class="card-header">
        <p class="card-header-title">Modification d'un pays</p>
    </header>
    <div class="card-content">
        <div class="content">
            <form class="form-horizontal" method="POST" action="{{ route('objet.update', $objet->id) }}">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="field">
                    <label class="label">Nom du pays</label>
                    <div class="control">
                        <input id="nom" type="text"   name="nom" value="{{ old('nom',$objet->nom) }}" required>
                    </div>
                    @error('nom')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label for="nb_habitant" class="label">Nombre d'habitants</label>
                    <div class="control">
                        <input id="nb_habitant" type="numeric" name="nb_habitant" value="{{ old('duree',$leObjet->libelle) }}" >
                        @error('nb_habitant')
                        <div class="invalid-feedback">Le nombre d'habitants est obligatoire et doit être inferieure à 32768</div>
                        @enderror
                    </div>
                </div>
                <div class="field">
                    <label for="superficie" class="label">Superficie</label>
                    <div class="control">
                        <input id="superficie" type="text"  name="superficie" value="{{ old('unite',$objet->superficie) }}" >
                        @error('superficie')
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
