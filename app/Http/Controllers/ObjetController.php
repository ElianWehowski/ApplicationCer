<?php

namespace App\Http\Controllers;

use App\Http\Requests\ObjetRequest;
use Illuminate\Http\Request;
use App\Models\Objet;
use App\Models\Categorie;
use Illuminate\Support\Facades\DB;


class ObjetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idCate=null)
    {
        if(!isset($idCate)){
            $idCate=null;
        }

        $toutLesObjets=DB::table('objets')
            ->join('categories', 'objets.idCategorie', '=', 'categories.id')
            ->select('objets.*', 'categories.id as idCategorie', 'categories.libelle')
            ->get();

        $categories = DB::table('categories')->get();
        return view('objet/indexObjet',compact('toutLesObjets', 'categories', 'idCate'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Categorie::all();
        return view('objet/createObjet', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ObjetRequest $request,Objet $objet)
    {
        $objet->prix=$request->prix;
        $objet->idProprietaire=$request->idProprietaire;
        $objet->idAcheteur=null;
        $objet->nom=$request->nom;
        $objet->idCategorie=$request->categorie;
        $objet->dateOuverture=$request->ouverture;
        $objet->dateFermeture=$request->fermeture;
        $objet->vendu=0;
        $objet->save();
//        $objet = Objet::create($request->all());
//        $objet->categorie()->attach($request->categorie);
        return redirect()->route('objet.index')->with('info','L\'enchère ' . $objet->nom . ' a été créé');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Objet $objet)
    {
        $encheres = DB::table('encheres')->get();
        return view('objet/showObjet', compact('objet', 'encheres'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Objet $objet)
    {
        return view('objet/editObjet', compact('objet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ObjetRequest $request, Objet $objet)
    {
        $objet->update($request->all());
        return redirect()->route('objet.index')->with('info', 'Le pays a bien été modifié');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Objet $objet)
    {
        $objet->delete();
        return redirect()->route('objet.index')->with('info', 'Le pays a bien été suprimé');
    }
}
