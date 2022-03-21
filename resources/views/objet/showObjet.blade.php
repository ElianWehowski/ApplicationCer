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
    <a href="{{route('objet.index')}}"><img src="../images/logoCer.png" width="150px"height="150px" ><br/><br/></a>

    <div class="card">
        <header class="card-header">
            <p class="card-header-title"><strong>Nom de l'objet</strong> : {{ $objet->nom }}</p>
        </header>
        <div class="card-content">
            <div class="content">
                <p>Prix de l'objet : {{ $objet->prix }} €</p>
                <p>Catégorie de l'objet : {{ ucfirst($objetBDD[0]->libelle) }}</p>
                <p>Date ouverture : {{ $objet->dateOuverture }} .  <strong>Date fermeture : {{ $objet->dateFermeture }}</strong></p>
                <p>Nombre d'enchère : {{ sizeof($encheres)  }} </p>
                Derniere enchere : <?php if (isset($encheres[0])){echo $encheres[0]->dateEnchere;}else{echo"Aucune enchere";}   ?></p>
            </div>
            @if (Route::has('login'))
                <div class="content">
                    @auth
                        <form action="{{ route('objet.bid', $objet->id) }}" method="post">
                            @method('PUT')
                            @csrf
                            <input class="input" type="number" name="prix" value="{{ $objet->prix }}" min="{{ $objet->prix }}" max="500000"/>
                            <br><br>
                            <button class="button is-info" type="submit">Enchérir</button>
                        </form>
                                <br/>

                        @if($user = Auth::user()->type == "admin")
                                <form action="{{ route('objet.destroy', $objet->id) }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                              <button class="button is-danger" type="submit">Supprimer</button>
                            </form>

                    @endif
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
