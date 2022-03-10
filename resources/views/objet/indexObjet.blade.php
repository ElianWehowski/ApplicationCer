@extends('template1')
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

        <a class="button is-info" href="{{ route('objet.create') }}">Créer un pays</a>
    </header>
    <div class="card-content">


            <table class="table is-hoverable" >
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom de l'objet</th>
                        <th>Prix</th>
                        <th>Date Ouverture</th>
                        <th>Date Fermeture</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($toutLesObjets as $objet)
                    <tr>
                        <td>{{ $objet->idObjet }}</td>
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
                    @endforeach
                </tbody>
            </table>

    </div>
</div>
@endsection
