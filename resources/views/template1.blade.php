<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ApplicationCer'</title>
    <!--url() construit une urle à partir de l'URL courante : public-->
    <link rel="stylesheet" href="{{ url('css/bulma.min.css') }}" />
    @yield('css')
</head>
<body>
<main class="section">
    <div class="container">
        <div class="card" style="width:100%">

            <?php
            $url = URL::current();
            if(substr($url,16)==""){
                echo '<img src="images/logoCer.png" width="150px"height="150px"><br/><br/>';
            }else{
                echo '<a href="'.route('objet.index').'"><img src="../../images/logoCer.png" width="150px"height="150px"></a><br/><br/>';
            }
            ?>

            <header class="card-header">
                @if(Request::route()->getName()=="objet.index")
                    <p class="card-header-title">Liste des objets</p>
                @elseif(Request::route()->getName()=="objet.categorie")
                    <p class="card-header-title">Liste des objets</p>
                @elseif(Request::route()->getName()=="objet.view")
                    <p class="card-header-title">Liste des objets</p>
                @elseif(URL::current()!="")
                    <p class="card-header-title">Liste des objets</p>
                @elseif(Request::route()->getName()=="objet.edit")
                    <p class="card-header-title">Modifier l'objet</p>
                @elseif(Request::route()->getName()=="objet.show")
                    <p class="card-header-title">Enchere pour l'objet</p>
                @elseif(Request::route()->getName()=="enchere.create")
                    <p class="card-header-title">Création d'une enchère</p>
                @elseif(Request::route()->getName()=="categorie.create")
                    <p class="card-header-title">Création d'une catégorie</p>

                @endif
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
                                        @if(Request::route()->getName()=="objet.view")
                                            <a class="dropdown-item" href="{{ route('objet.index') }}">Retour aux encheres</a>
                                        @endif
                                        <a class="dropdown-item" href="{{ route('objet.view') }}">Voir mes objets</a>
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

            @yield('contenu')
        </div>
</main>

</body>
</html>
