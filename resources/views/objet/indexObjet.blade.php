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
    <?php // header("Refresh: 30;url='http://cer/'");?>
    @if(session()->has('info'))
        <div class="notification is-success">
            {{ session('info') }}
        </div>
    @endif
    <div class="card" style="width:100%">
        <div class="card-content">

            <div class="select">
                <select id="cate" onchange="window.location.href = this.value">
                    <option value="{{ route('objet.index') }}">Toutes les catégories</option>
                    @foreach($categories as $categorie)
                        <option value="{{ route('objet.categorie', $categorie->id) }}"
                            {{ $idCate == $categorie->id ? 'selected' : '' }}>{{ ucfirst($categorie->libelle) }}</option>
                    @endforeach
                </select>

            </div>
            <label for="tablecateauActif" class="inline-flex"><?php if(count($toutLesObjets)>1){ echo "Résultats : ".count($toutLesObjets);}elseif(count($toutLesObjets)==0){echo "Aucun résultat";}else{echo "Résultat";} ?></label>
            <table name="tablecateauActif" class="table is-hoverable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Catégorie</th>
                        <th>Nom de l'objet</th>
                        <th>Prix</th>
                        <th>Date d'ouverture</th>
                        <th>Date de fermeture</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $currentDate = date('Y-m-d H:i:s', time());
                        $currentDatePlus10 = date('Y-m-d H:i:s', strtotime("+10 minutes"));
                    ?>
                    @foreach($toutLesObjets as $objet)
                        @if($objet->idCategorie == $idCate || $idCate==null)
                            @if ( $objet->dateFermeture > $currentDate && $objet->dateOuverture < $currentDate )
                                <tr>
                                    <td>{{ $objet->id }}</td>
                                    <td>{{ ucfirst($categories[$objet->idCategorie-1]->libelle) }}</td>
                                    <td>{{ ucfirst($objet->nom)}}</td>
                                    <td>{{ $objet->prix }} </td>
                                    <td>{{ substr($objet->dateOuverture,0,16)}} </td>
                                    <td>{{ substr($objet->dateFermeture,0,16)}} </td>
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
                                            @endif
                                        @endauth
                                    @endif
                                </tr>
                            @endif
                        @endif

                    @endforeach
                    @foreach($toutLesObjets as $objet)
                        @if ( ($objet->dateOuverture > $currentDate) )

                            <tr>
                                <td>{{ $objet->id }}</td>
                                <td>{{ ucfirst($categories[$objet->idCategorie-1]->libelle) }}</td>
                                <td>{{ ucfirst($objet->nom)}}</td>
                                <td>{{ $objet->prix }} </td>
                                <td>{{ substr($objet->dateOuverture,0,16)}} </td>
                                <td>{{ substr($objet->dateFermeture,0,16)}} </td>

                                <td><a class="button is-danger" disabled>Fermé</a></td>
                            </tr>
                        @endif
                        @if ( ($objet->dateFermeture < $currentDate) )

                            <tr>
                                <td>{{ $objet->id }}</td>
                                <td>{{ ucfirst($categories[$objet->idCategorie-1]->libelle) }}</td>
                                <td>{{ ucfirst($objet->nom)}}</td>
                                <td>{{ $objet->prix }} </td>
                                <td>{{ substr($objet->dateOuverture,0,16)}} </td>
                                <td>{{ substr($objet->dateFermeture,0,16)}} </td>

                                <td><a class="button is-info" href="{{ route('enchere.show', $objet->id) }}">Résumé</a></td>
                                <td><a class="button is-danger" disabled>Clos</a></td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
