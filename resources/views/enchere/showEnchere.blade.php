@extends('template1')
@section('contenu')
    @if(session()->has('info'))
        <div class="notification is-success">
            {{ session('info') }}
        </div>
    @endif
    @if(session()->has('danger'))
        <div class="notification is-danger">
            {{ session('danger') }}
        </div>
    @endif
    <?php
    $taille = sizeof($encheres)-1;
    ?>

        <div class="card-content">
            <div class="content">
                <p>Nom de l'objet : {{ $enchere->nom }}</p>
                <p>Prix final : {{ $enchere->prix }} €</p>
                <p>Catégorie de l'objet : {{ ucfirst($enchereBDD[0]->libelle) }}</p>
                <p>Date ouverture : {{ substr($enchere->dateOuverture,0,16) }} .  <strong>Date fermeture : {{ substr($enchere->dateFermeture,0,16) }}</strong></p>
                <p>Nombres d'enchères : {{ sizeof($encheres)  }} </p>
                Derniere enchère : <?php if (isset($encheres[$taille])){echo substr($encheres[$taille]->dateEnchere,0,16);}   ?>

                <?php
                if (isset($encheres[0])){echo"<p> L'acheteur est : ".$encheres[$taille]->userName." </p>";}else{echo"Aucune enchère, propriétaire d'origine : ";}
                ?>

            </div>
        </div>

        <footer class="card-footer is-centered">
            <a class="button is-info" href="{{ route('objet.index') }}">Retour à la liste</a>
        </footer>
    </div>
@endsection
