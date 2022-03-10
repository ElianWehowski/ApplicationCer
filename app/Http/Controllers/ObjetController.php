<?php

namespace App\Http\Controllers;

use App\Http\Requests\ObjetRequest;
use Illuminate\Http\Request;
use App\Models\Objet;
use Illuminate\Support\Facades\DB;


class ObjetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $toutLesObjets=DB::table('objets')
            ->join('categories', 'objets.idCategorie', '=', 'categories.idCategorie')
            ->select('objets.*', 'categories.*')
            ->get();

        $categories = DB::table('categories')->get();
        $affiche = 1;
        return view('objet/indexObjet',compact('toutLesObjets', 'categories', 'affiche'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('objet/createObjet');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ObjetRequest $request,Objet $objet)
    {
        $objet->prix=0;
        $objet->idProprietaire=$request->nb_habitant;
        $objet->idAcheteur=$request->superficie;
        $objet->nom=$request->superficie;
        $objet->idCategorie=$request->superficie;
        $objet->dateOuverture=$request->superficie;
        $objet->dateFermeture=$request->superficie;
        $objet->vendu=$request->superficie;
        $objet->save();
        return redirect()->route('objet.index')->with('info','Le pays ' . $objet->nom . ' a été créé');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Objet $objet)
    {
        return view('objet/showObjet', compact('objet'));
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
        return redirect()->route('objet/objet.indexObjet')->with('info', 'Le pays a bien été suprimé');
    }
}
