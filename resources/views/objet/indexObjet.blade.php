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
    <?php
    $url = URL::current();
    if(substr($url,16)==""){
        echo '<img src="images/logoCer.png" width="150px"height="150px"><br/><br/>';
    }else{
        echo '<a href="'.route('objet.index').'"><img src="../../images/logoCer.png" width="150px"height="150px"></a><br/><br/>';
    }
    ?>


    <div class="card" style="width:100%">

        <header class="card-header">
            <p class="card-header-title">Liste des objets</p>
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-8 py-6 sm:block">
                    @auth
                        <div class="button" disabled=""> Utilisateur : {{ $userid =Auth::user()->name}} </div>
                        <div class="dropdown is-hoverable">
                            <div class="dropdown-trigger">
                                <button class="button" aria-haspopup="true" aria-controls="dropdown-menu">
                                    <span><a>Gestion</a></span>
                                </button>
                            </div>
                            <div class="dropdown-menu" id="dropdown-menu" role="menu">

                                <div class="dropdown-content">
                                    @if(Auth::user()->type == "admin")
                                        <a class="dropdown-item" href="{{ route('enchere.create') }}">Créer une enchère</a>
                                        <a class="dropdown-item" href="{{ route('categorie.create') }}">Créer une catégorie</a>
                                        <a class="dropdown-item" href="{{ route('objet.flush') }}">Changer les données</a>
                                    @endif
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a class="dropdown-item" :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();"> {{ __('Déconnexion') }} </a>
                                    </form>
                                </div>

                            </div>
                        </div>
                    @else
                        <a class="button is-info" href="{{ route('login') }}" >Se connecter</a>

                        @if (Route::has('register'))
                            <a  class="button is-info" href="{{ route('register') }}">S'inscrire</a>
                        @endif
                    @endauth
                </div>
            @endif

        </header>
        <div class="card-content">
            <div class="select">
                <select onchange="window.location.href = this.value">
                    <option value="{{ route('objet.index') }}">Toutes les catégories</option>
                    @foreach($categories as $categorie)
                        <option value="{{ route('objet.categorie', $categorie->id) }}"
                            {{ $idCate == $categorie->id ? 'selected' : '' }}>{{ ucfirst($categorie->libelle) }}</option>
                    @endforeach
                </select>
            </div>
            <table class="table is-hoverable">
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
                <?php
                $currentDate = date('Y-m-d H:i:s', time());
                $currentDatePlus10 = date('Y-m-d H:i:s', strtotime("+10 minutes"));
                ?>
                @foreach($toutLesObjets as $objet)

                    @if($objet->idCategorie == $idCate || $idCate==null)
                        @if ( $objet->dateFermeture > $currentDate )
                            <tr>
                                <td>{{ $objet->id }}</td>
                                <td>{{ ucfirst($categories[$objet->idCategorie-1]->libelle) }}</td>
                                <td>{{ ucfirst($objet->nom)}}</td>
                                <td>{{ $objet->prix }} </td>
                                <td>{{ $objet->dateOuverture }} </td>
                                <td>{{ $objet->dateFermeture }} </td>


                                <td><a class="button is-primary" id="enchérir-{{$objet->id}}" href="{{ route('objet.show', $objet->id) }}">Ouvert</a></td>

                                @if (Route::has('login'))

                                    @auth
                                        @if($user = Auth::user()->type == "admin")
                                            @csrf
                                            <td><a id="enchérir-{{$objet->id}}" class="button is-warning" href="{{ route('objet.edit', $objet->id) }}">Modifier</a></td>
                                            <td>
                                                <form action="{{ route('objet.destroy', $objet->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button class="button is-danger" type="submit" id="enchérir-{{$objet->id}}">Supprimer</button>
                                                </form>
                                            </td>
                            </tr>
                        @endif
                    @endauth
                    @endif
                    @endif
                    @endif

                @endforeach
                @foreach($toutLesObjets as $objet)
                    @if($objet->idCategorie == $idCate || $idCate==null)
                        @if ( ($objet->dateFermeture < $currentDate) )

                            <tr>
                                <td>{{ $objet->id }}</td>
                                <td>{{ ucfirst($categories[$objet->idCategorie-1]->libelle) }}</td>
                                <td>{{ ucfirst($objet->nom)}}</td>
                                <td>{{ $objet->prix }} </td>
                                <td>{{ $objet->dateOuverture }} </td>
                                <td>{{ $objet->dateFermeture }} </td>

                                <td><a class="button is-info" href="{{ route('enchere.show', $objet->id) }}">Résumé</a></td>
                                <td><a class="button is-danger" disabled>Fermé</a></td>
                            </tr>
                    @endif
                    @endif

                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
