<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;
    protected $fillable = ['libelle'];

    public function objets(){
//retourne la collection de personnages pour un album
        return $this->belongsToMany(Objet::class);
    }
    public function categories(){
//retourne la collection de personnages pour un album
        return $this->belongsToMany(Categorie::class);
    }
}
