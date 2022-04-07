@extends('template1')
@section('contenu')

<?php
$dOuverture = date_create($objet->dateOuverture);
$dOuverture = strtotime($dOuverture->format('Y-m-d\TH:i:s'));
$dFermeture = date_create($objet->dateFermeture);
$dFermeture = strtotime($dFermeture->format('Y-m-d\TH:i:s'));
//var_dump($objet);
?>

    <div class="card">

        <div class="card-content">
            <div class="content">
                <form class="form-horizontal" method="POST" id="myForm" action="{{ route('objet.update', $objet->id) }}">
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
                            <input class="input" id="prix" type="numeric" disabled="disabled" name="prix" value="{{ old('duree',$objet->prix) }}" >
                            @error('prix')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="field">
                        <label class="label" for="IdCategorie">Catégorie</label>
                        <div class="control">
                            <select class="select" id ="IdCategorie" name="IdCategorie">
                                @foreach($categories as $categorie)
                                    <option value="{{ $categorie->id }}" {{ $categorie->id==$objet->idCategorie ? 'selected' : '' }}>{{ ucfirst($categorie->libelle) }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('idCategorie')
                        <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field">
                        <label for="dateOuverture" class="label">Date d'ouverture</label>
                        <div class="control">
                            <input class="input" id="dateOuverture" type="datetime-local"  name="dateOuverture" value="{{ old('unite',date('Y-m-d\TH:i:s',$dOuverture)) }}" >
                            @error('dateOuverture')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="field">
                        <label for="dateFermeture" class="label">Date de fermeture</label>
                        <div class="control">
                            <input class="input" id="dateFermeture" type="datetime-local"  name="dateFermeture" value="{{ old('unite',date('Y-m-d\TH:i:s',$dFermeture)) }}" >
                            @error('dateFermeture')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <button class="button is-link" type="button" onclick="ValidJS()">Envoyer</button>
                            <a class="button is-info" href="{{ route('objet.index') }}">Retour à la liste</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script type="text/javascript">

    function verifDate(){
        var valid = true;
        var debut = document.getElementById("dateOuverture");
        var fin = document.getElementById("dateFermeture");
        var ddebut = debut.value.substr(0,10);
        var Ddebut = debut.value.substr(11,5);
        var dateDebut = new Date(ddebut+" "+Ddebut);
        var dfin = fin.value.substr(0,10);
        var Dfin = fin.value.substr(11,5);
        var dateFin = new Date(dfin+" "+Dfin);
        // alert(dateDebut.getTime() +" fin:"+ dateFin.getTime());
        if(dateDebut.getTime() < dateFin.getTime())
        {
            // window.alert("c'est good");
        }
        else{
            window.alert("les dates ne sont pas ordonnées");
            valid = false;
        }
        return valid;
    }

    function ValidJS(){
        var form = document.forms["myForm"];
        var valid = verifDate();
        if(valid){
            form.submit();
        }

    }

</script>

@endsection
