    @extends('template1')
    @section('contenu')
        <div class="card">
            <header class="card-header">
                <p class="card-header-title"><strong>Nom du pays</strong> : {{ $toutlespay->nom }}</p>
            </header>
            <div class="card-content">
                <div class="content">
                    <p>Nombre d'habitants : {{ $toutlespay->nb_habitant }}</p>
                    <p>Superficie: {{ $toutlespay->superficie }}</p>
                    <p>Id du pays : {{ $toutlespay->id }}</p>
                </div>
            </div>
            <footer class="card-footer is-centered">
            <a class="button is-info" href="{{ route('toutlespays.index') }}">Retour à la liste</a>
        </footer>
        </div>
    @endsection
