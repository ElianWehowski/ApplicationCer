@extends('../template1')
@section('css')
    <style>
        .card-footer {
            justify-content: center;
            align-items: center;
            padding: 0.4em;
        }
        select, .is-info {
            margin: 0.3em;
        }
    </style>

@endsection
@section('contenu')
    @if(session()->has('info'))
        <div class="notification is-success">
            {{ session('info') }}
        </div>
    @endif

    <div class="card" style="width:100%">

        <header class="card-header">
            <p class="card-header-title">Pays</p>
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a class="button is-info" href="{{ url('/dashboard') }}" >Dashboard</a>
                        <a class="button is-info" href="{{ route('objet.create') }}">Créer un pays</a>
                    @else
                        <a class="button is-info" href="{{ route('login') }}" >Log in</a>

                        @if (Route::has('register'))
                            <a  class="button is-info" href="{{ route('register') }}" >Register</a>
                        @endif
                    @endauth
                </div>
            @endif

        </header>
        <div class="card-content">
            <form action="{{ route('objet.index') }}" method="POST">
                @csrf
                <select name="categorie" id="cherchecategorie">
                    <option value = "rien">tout afficher</option>
                    @foreach($categories as $cat)
                        @if(isset($_POST['categorie']) && $cat->idCategorie == $_POST['categorie'])
                            <option value = "{{$cat->idCategorie}}" selected>{{$cat->libelle}}</option>
                        @else
                            <option value = "{{$cat->idCategorie}}">{{$cat->libelle}}</option>
                        @endif
                    @endforeach
                </select>
                <button type="submit">Rechercher</button>
            </form>


            <table class="table is-hoverable" >
                <thead>
                <tr>
                    <th>#</th>
                    <th>Catégorie</th>
                    <th>Nom de l'objet</th>
                    <th>Prix</th>
                    <th>Date Ouverture</th>
                    <th>Date Fermeture</th>
                </tr>
                </thead>
                <tbody>
                @foreach($toutLesObjets as $objet)

                    @if(!isset($_POST['categorie']) || isset($_POST['categorie']) && $objet->idCategorie == $_POST['categorie'] || isset($_POST['categorie']) && $_POST['categorie']=="rien")
                        <tr>
                            <td>{{ $objet->idObjet }}</td>
                            <td>{{ $objet->libelle }}</td>
                            <td>{{ $objet->nom}}</td>
                            <td>{{ $objet->prix }} </td>
                            <td>{{ $objet->dateOuverture }} </td>
                            <td>{{ $objet->dateFermeture }} </td>
                            <td><a class="button is-primary" href="{{ route('objet.show', $objet->idObjet) }}">Voir</a></td>
                            <td><a class="button is-warning" href="{{ route('objet.edit', $objet->idObjet) }}">Modifier</a></td>
                            <td>
                                <form action="{{ route('objet.destroy', $objet->idObjet) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button class="button is-danger" type="submit">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection
