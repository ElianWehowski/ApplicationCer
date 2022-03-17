    @extends('template1')
    @section('contenu')
        <div class="card">
            <header class="card-header">
                <p class="card-header-title"><strong>Nom de l'objet</strong> : {{ $objet->nom }}</p>
            </header>
            <div class="card-content">
                <div class="content">
                    <p>Prix de l'objet : {{ $objet->prix }}</p>
                    <p>Nombre d'enchères : </p>
                    <p>Date ouverture : {{ $objet->dateOuverture }}</p>
                    <p>Date fermeture : {{ $objet->dateFermeture }}</p>
                </div>
            </div>
            <footer class="card-footer is-centered">
            <a class="button is-info" href="{{ route('objet.index') }}">Retour à la liste</a>
        </footer>
        </div>
    @endsection
