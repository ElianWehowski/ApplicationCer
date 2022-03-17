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
                <div class="hidden fixed top-0 right-0 px-8 py-6 sm:block">
                @auth

                    <!--   <a class="button is-info" href="{{ url('/dashboard') }}" >Dashboard</a> !-->

                        <div class="dropdown is-hoverable">
                            <div class="dropdown-trigger">
                                <button class="button" aria-haspopup="true" aria-controls="dropdown-menu">
                                    <span><a>{{ $userid =Auth::user()->name}} </a></span>
                                </button>
                            </div>
                            <div class="dropdown-menu" id="dropdown-menu" role="menu">
                                <div class="dropdown-content">
                                    <a class="dropdown-item" href="{{ route('objet.create') }}">Créer une enchere</a>
                                    <a class="dropdown-item" href="{{ route('objet.create') }}">Créer une catégorie</a>
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
                            <a  class="button is-info" href="{{ route('register') }}" >S'inscrire</a>
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

                    @if($objet->idCategorie == $idCate || $idCate==null)
                        <tr>
                            <td>{{ $objet->id }}</td>
                            <td>{{ ucfirst($categories[$objet->idCategorie-1]->libelle) }}</td>
                            <td>{{ ucfirst($objet->nom)}}</td>
                            <td>{{ $objet->prix }} </td>
                            <td>{{ $objet->dateOuverture }} </td>
                            <td>{{ $objet->dateFermeture }} </td>
                            <?php
                            $currentDate = date('Y-m-d h:i:s', time());
                            ?>
                            @if ( $objet->dateFermeture > $currentDate )

                                <td><a class="button is-primary" href="{{ route('objet.show', $objet->id) }}">Ouvert</a></td>
                            @else
                                <td><a class="button is-danger" disabled>Fermé</a></td>
                            @endif
                            @if (Route::has('login'))

                                @auth
                                    @if($user = Auth::user()->type == "admin")
                                        @csrf
                                        <td><a class="button is-warning" href="{{ route('objet.edit', $objet->id) }}">Modifier</a></td>
                                        <td>
                                            <form action="{{ route('objet.destroy', $objet->id) }}" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button class="button is-danger" type="submit">Supprimer</button>
                                            </form>
                                        </td>


                                    @endauth
                                @endif
                            @endif
                            @endif
                        </tr>

                        @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection
