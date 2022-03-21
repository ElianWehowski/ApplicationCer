<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnchereRequest;
use App\Http\Requests\ObjetRequest;
use App\Models\Categorie;
use App\Models\Enchere;
use App\Models\Objet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EnchereController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Categorie::all();
        return view('enchere/createEnchere', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ObjetRequest $request,Objet $enchere)
    {
        $enchere->prix=$request->prix;
        $enchere->idProprietaire=$request->idProprietaire;
        $enchere->idAcheteur=null;
        $enchere->nom=$request->nom;
        $enchere->idCategorie=$request->categorie;
        $enchere->dateOuverture=$request->ouverture;
        $enchere->dateFermeture=$request->fermeture;
        $enchere->vendu=0;
        $enchere->save();
//        $objet = Objet::create($request->all());
//        $objet->categorie()->attach($request->categorie);
        return redirect()->route('objet.index')->with('info','L\'enchère ' . $enchere->nom . ' a été créé');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Objet $enchere)
    {

        $enchereBDD = DB::table('objets')
            ->join('users', 'objets.idProprietaire', '=', 'users.id')
            ->join('categories', 'objets.idCategorie', '=', 'categories.id')
            ->select('objets.*', 'categories.id as idCategorie', 'categories.libelle','users.name as userName')
            ->where('objets.id','=',$enchere->id)
            ->get();


        $encheres = DB::table('encheres')
            ->join('users', 'encheres.idEncherisseur', '=', 'users.id')
            ->select('*','users.id as userId','users.name as userName')
            ->where('encheres.idObjet','=',$enchere->id)
            ->orderBy('prixEnchere','asc')
            ->get();
        return view('enchere/showEnchere', compact('enchere', 'encheres','enchereBDD'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EnchereRequest $request, Enchere $enchere)
    {
//
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
