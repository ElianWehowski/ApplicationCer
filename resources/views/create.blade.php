@extends('template1')
@section('contenu')
<div class="card">
    <header class="card-header">
        <p class="card-header-title">Création d'un pays</p>
    </header>
    <div class="card-content">
        <div class="content">
            <form action="{{ route('toutlespays.store') }}" method="POST">
                @csrf
                <div class="field">
                    <label class="label">Nom du pays</label>
                    <div class="control">
                        <input class="input" type="numeric" name="nom" value="{{ old('nom') }}">
                    </div>
                    @error('nom')
                    <p class="help is-danger">{{ $message }}</p>
                    @enderror

                </div>

                <div class="field">
                    <label class="label">Nombre d'habitants</label>
                    <div class="control">
                        <input class="input" type="numeric" name="nb_habitant" value="{{ old('nb_habitant') }}">
                    </div>
                    @error('nb_habitant')
                    <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="field">
                    <label class="label">Superficie du pays</label>
                    <div class="control">
                        <input class="input" type="text" name="superficie" value="{{ old('superficie') }}">
                    </div>
                    @error('superficie')
                    <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="field">
                    <div class="control">
                        <button class="button is-link">Envoyer</button>

                        <a class="button is-info" href="{{ route('toutlespays.index') }}">Retour à la liste</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
