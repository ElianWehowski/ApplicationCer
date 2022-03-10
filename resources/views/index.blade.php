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

        <a class="button is-info" href="{{ route('toutlespays.create') }}">Créer un pays</a>
    </header>
    <div class="card-content">


            <table class="table is-hoverable" >
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom du pays</th>
                        <th>Nombre d'habitants</th>
                        <th>Superficie</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lespays as $pays)
                    <tr>
                        <td>{{ $pays->id }}</td>
                        <td>{{ $pays->nom}}</td>
                        <td>{{ $pays->nb_habitant }} </td>
                        <td>{{ $pays->superficie }}m²</td>
                        <td><a class="button is-primary" href="{{ route('toutlespays.show', $pays->id) }}">Voir</a></td>
                        <td><a class="button is-warning" href="{{ route('toutlespays.edit', $pays->id) }}">Modifier</a></td>
                        <td>
                            <form action="{{ route('toutlespays.destroy', $pays->id) }}" method="post">
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
