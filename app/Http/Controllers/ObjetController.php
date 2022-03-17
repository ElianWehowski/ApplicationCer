<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnchereRequest;
use App\Http\Requests\ObjetRequest;
use App\Models\Enchere;
use DateTimeInterface;
use Illuminate\Http\Request;
use App\Models\Objet;
use App\Models\Categorie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ObjetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idCate = null)
    {
        $toutLesObjets=DB::table('objets')
            ->join('categories', 'objets.idCategorie', '=', 'categories.id')
            ->select('objets.*', 'categories.id as idCategorie', 'categories.libelle')
            ->get();

        $categories = DB::table('categories')->get();
        return view('objet/indexObjet',compact('toutLesObjets', 'categories'));
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
        return view('objet/editObjet', compact('objet',));
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
        $idObj =$objet->id;
        $objetBDD = DB::table('objets')
            ->select('*')
            ->where('objets.id','=',$objet->id)
            ->get();

        foreach ($objetBDD as $good) {
            $prixBDD = $good->prix;
            if ($prixObj > $prixBDD) {
                $objet->update($Orequest->all());
                $succes = 1;
                $enchere->prixEnchere=$prixObj;
                $enchere->idObjet=$idObj;
                $enchere->idEncherisseur= Auth::user()->id;
                $enchere->dateEnchere= DateTimeInterface::ISO8601;
                $enchere->save($Erequest->all());
            }
        }



        if($succes==1){
            return redirect()->route('objet.index')->with('info', 'L\'enchere a été pris en compte');
        }else{
            return redirect()->route('objet.index')->with('info', 'Le prix d\'enchere doit etre supérieur au prix d\'origine objet : '.$prixObj.' prixBdd : '.$prixBDD);

        }
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
