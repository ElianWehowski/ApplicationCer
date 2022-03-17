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

    <div class="card">
        <header class="card-header">
            <p class="card-header-title"><strong>Enchere terminée ! Objet </strong> : {{ $enchere->nom }}</p>
        </header>
        <div class="card-content">
            <div class="content">
                <p>Prix final : {{ $enchere->prix }} €</p>
                <p>Catégorie de l'objet : {{ ucfirst($enchereBDD[0]->libelle) }}</p>
                <p>Date ouverture : {{ $enchere->dateOuverture }} .  <strong>Date fermeture : {{ $enchere->dateFermeture }}</strong></p>
                <p>Nombre d'enchères : {{ sizeof($encheres)  }} </p>
                Derniere enchere : <?php if (isset($encheres[0])){echo $encheres[0]->dateEnchere;}else{echo"Aucune enchere";}   ?>

                <?php
                if (isset($encheres[0])){echo"<p> L'acheteur est : ".$encheres[0]->userName." </p>";}else{echo"Aucune enchere, propriétaire d'origine : ";}

                ?>

            </div>
        </div>

        <footer class="card-footer is-centered">
            <a class="button is-info" href="{{ route('objet.index') }}">Retour à la liste</a>
        </footer>
    </div>
@endsection
