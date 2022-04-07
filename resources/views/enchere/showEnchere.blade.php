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
    <?php $taille = sizeof($encheres)-1; ?>
    <div class="card-content">
        <div class="content">
            <p>Nom de l'objet : <strong>{{ $enchere->nom }}</strong><br/>
                Prix final : <strong>{{ $enchere->prix }} €</strong><br/>
                Catégorie de l'objet : <strong>{{ ucfirst($enchereBDD[0]->libelle) }}</strong>
            </p>
            <p>Date d'ouverture : <strong>{{ substr($enchere->dateOuverture,0,16) }}</strong>
                <br/>Date de fermeture : <strong>{{ substr($enchere->dateFermeture,0,16) }}</strong>
            </p>
            <?php
            $nbEncheres = sizeof($encheres);
            if ($nbEncheres>=1){
                echo " <p>Nombre d'enchère : <strong>$nbEncheres</strong><br/>
                Dernière enchère : <strong>".substr($encheres[$taille]->dateEnchere,0,16)."<br/></strong> L'acheteur est : <strong>".$encheres[$taille]->userName." </strong></p>";
            }else{
                echo " <p><strong>Aucune enchère, propriétaire d'origine.</strong></p>";
            }?>
        </div>
    </div>
    <footer class="card-footer is-centered">
        <a class="button is-info" href="{{ route('objet.index') }}">Retour à la liste</a>
    </footer>
    </div>
@endsection
