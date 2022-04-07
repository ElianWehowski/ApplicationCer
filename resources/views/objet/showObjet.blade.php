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
    <input type="number" id="idobj" hidden="hidden" value="{{$objet->id}}">
    <div class="card">
        <div class="card-content">
            <div class="content">
                <p>Nom de l'objet : {{ $objet->nom }} </p>
                <p id="prix">Prix de l'objet : {{ $objet->prix }} €</p>
                <p>Catégorie de l'objet : {{ ucfirst($objetBDD[0]->libelle) }}</p>
                <p>Date ouverture : {{ substr($objet->dateOuverture,0,16)}} .  <strong>Date fermeture : {{ substr($objet->dateFermeture,0,16) }}</strong></p>
                <p>Nombre d'enchère : {{ sizeof($encheres)  }} </p>
                Derniere enchere : <?php if (isset($encheres[0])){echo substr($encheres[0]->dateEnchere,0,16);}else{echo"Aucune enchère";}   ?></p>
            </div>
            @if (Route::has('login'))
                <div class="content">
                    @auth
                        <form action="{{ route('objet.bid', $objet->id) }}" method="post">
                            @method('PUT')
                            @csrf
                            <input class="input" id="inputprix" type="number" name="prix" value="{{ $objet->prix }}" min="{{ $objet->prix }}" max="500000"/>
                            <br><br>
                            <button class="button is-info" type="submit" >Enchérir</button>
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

    <script type="text/javascript">
        function refreshData(){
            var xhr = new XMLHttpRequest();
            var ajax = "{{asset("ajax/ajax.php")}}";
            var idobj = document.getElementById('idobj');
            xhr.open('GET', ajax+'?idobj=' + idobj.value);
            xhr.send(null);

            xhr.onreadystatechange = function () {
                //alert(xhr.readyState);
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var prix = xhr.response;
                    var slotprix = document.getElementById("prix");
                    slotprix.innerHTML = prix;
                }
            }
        }

        refreshData(); // This will run on page load
        setInterval(function(){
            refreshData() // this will run after every 5 seconds
        }, 1000);

    </script>
@endsection
