    @extends('template1')
    @section('contenu')
        <div class="card">
            <header class="card-header">
                <p class="card-header-title"><strong>Nom de l'objet</strong> : {{ $objet->nom }}</p>
            </header>
            <div class="card-content">
                <div class="content">
                    <p>Prix de l'objet : {{ $objet->prix }}</p>
                    <p>Nombre d'enchérisseurs :  </p>
                    <p>Date ouverture : {{ $objet->dateOuverture }}</p>
                    <p>Date fermeture : {{ $objet->dateFermeture }}</p>
                </div>
                @if (Route::has('login'))
                    <div class="content">
                        @auth
                            <form action="{{ route('objet.bid', $objet->id) }}" method="post">
                                @method('PUT')
                                @csrf
                                <input class="input" type="text" name="prix"/>
                            <button class="button is-info" type="submit">Encherir</button>
                    </form>
                            <form action="{{ route('objet.destroy', $objet->id) }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button class="button is-danger" type="submit">Supprimer</button>
                            </form>
                        @else
                        @endauth
                    </div>
                @endif
            </div>
            <footer class="card-footer is-centered">
            <a class="button is-info" href="{{ route('objet.index') }}">Retour à la liste</a>
        </footer>
        </div>

    @endsection
