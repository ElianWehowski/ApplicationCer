    @extends('template1')
    @section('contenu')
        <div class="card">
            <header class="card-header">
                <p class="card-header-title"><strong>Nom de l'objet</strong> : {{ $objet->nom }}</p>
            </header>
            <div class="card-content">
                <div class="content">
                    <p>Id du pays : {{ $objet->idObjet }}</p>
                </div>
            </div>
            <footer class="card-footer is-centered">
            <a class="button is-info" href="{{ route('objet.index') }}">Retour à la liste</a>
        </footer>
        </div>
    @endsection
