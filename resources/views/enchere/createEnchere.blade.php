@extends('template1')
@section('contenu')

    <div class="card">
        <div class="card-content">
            <div class="content">
                <form id="myForm" action="{{ route('enchere.store') }}" method="POST">
                    @csrf
                    <div class="field">
                        <label class="label">Nom de l'objet</label>
                        <div class="control">
                            <input class="input" type="numeric" id="nom" name="nom"  value="{{ old('nom') }}" required>
                        </div>
                        @error('nom')
                        <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <label class="label" for="categorie">Catégorie</label>
                    <div class="select">
                        <div class="control">
                            <select id="categorie" name="categorie">
                                @foreach($categories as $categorie)
                                    <option value="{{ $categorie->id }}" {{ in_array($categorie->id, old('categorie') ?: []) ? 'selected' : '' }}>{{ ucfirst($categorie->libelle) }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('categorie')
                        <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field">
                        <label class="label">Prix de départ</label>
                        <div class="control">
                            <input class="input" type="number" id="prix"  name="prix"  min="1" max="500000" value="{{ old('prix') }}" required>
                        </div>
                        @error('prix')
                        <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field">
                        <label class="label">Date d'ouverture de l'enchère</label>
                        <div class="control">
                            <input class="input" type="datetime-local"  id="dateOuverture" name="ouverture" value="{{ old('ouverture') }}" required>
                        </div>
                        @error('ouverture')
                        <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field">
                        <label class="label">Date de fermeture de l'enchère</label>
                        <div class="control">
                            <input class="input" type="datetime-local"  id="dateFermeture" name="fermeture" value="{{ old('fermeture') }}" required>
                        </div>
                        @error('fermeture')
                        <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <input type="hidden" name="idProprietaire" value="{{Auth::user()->id}}"></input>
                    <div class="field">
                        <div class="control">
                            <button class="button is-link" type="button" onclick="ValidJS()">Créer l'enchère</button>
                            <a class="button is-info" href="{{ route('objet.index') }}">Retour à la liste</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
   <script type="text/javascript">
       function verifDate(){
           var valid = true;
           var debut = document.getElementById("dateOuverture");
           var fin = document.getElementById("dateFermeture");
           var ddebut = debut.value.substr(0,10);
           var Ddebut = debut.value.substr(11,5);
           var dateDebut = new Date(ddebut+" "+Ddebut);
           var dfin = fin.value.substr(0,10);
           var Dfin = fin.value.substr(11,5);
           var dateFin = new Date(dfin+" "+Dfin);
           // alert(dateDebut.getTime() +" fin:"+ dateFin.getTime());
           if(dateDebut.getTime() < dateFin.getTime())
           {
               // window.alert("c'est good");
           }
           else{
               window.alert("Les dates ne sont pas ordonnées.");
               valid = false;
           }
           return valid;
       }

       function ValidJS(){
           var form = document.forms["myForm"];
           var valid = verifDate();
           var nom = document.getElementById("nom");
           var prix = document.getElementById("prix");
           if(nom.value == "" || nom.length > 190){
               valid = false;
               alert("Entrez un nom avec moins de 190 caractères.");
           }
           if(prix.value == "" || prix.value > 500000){
               valid = false;
               alert("Entrez un prix entre 0 et 500 000€.")
           }
           if(valid){
               form.submit();
           }
       }
   </script>
@endsection
