<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnchereRequest;
use App\Http\Requests\ObjetRequest;
use App\Models\Enchere;
use Illuminate\Http\Request;
use App\Models\Objet;
use App\Models\Categorie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;


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

        $objetBDD = DB::table('objets')
            ->join('categories', 'objets.idCategorie', '=', 'categories.id')
            ->select('objets.*', 'categories.id as idCategorie', 'categories.libelle')
            ->where('objets.id','=',$objet->id)
            ->get();


        $encheres = DB::table('encheres')
            ->select('*')
            ->where('encheres.idObjet','=',$objet->id)
            ->orderBy('dateEnchere','desc')
            ->get();
        return view('objet/showObjet', compact('objet', 'encheres','objetBDD'));
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
<<<<<<< Updated upstream
=======
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function bid(ObjetRequest $Orequest, Objet $objet,EnchereRequest $Erequest, Enchere $enchere)
    {
        $succes=0;
        $prixObj= $_POST['prix'];
        $dateJour = date('Y-m-d h:i:s', time());
        $idObj =$objet->id;
        $objetBDD = DB::table('objets')
            ->select('*')
            ->where('objets.id','=',$objet->id)
            ->get();


        foreach ($objetBDD as $good) {
            $prixBDD = $good->prix;
            if ($prixObj > $prixBDD && $good->dateFermeture > $dateJour ) {
                $enchere->prixEnchere=$prixObj;
                $enchere->idObjet=$idObj;
                $enchere->idEncherisseur= Auth::user()->id;
                $enchere->dateEnchere= date('Y-m-d h:i:s', time());
                $enchere->save($Erequest->all());

                $objet->update($Orequest->all());

                $succes = 1;

            }
        }



        if($succes==1){
            return redirect::back()->with('info', 'L\'enchère a été pris en compte');
        }else{
            return redirect::back()->with('danger', 'Le prix d\'enchère doit être supérieur au prix d\'origine de l\'objet');

        }
    }

    /**
>>>>>>> Stashed changes
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
