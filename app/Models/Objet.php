<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objet extends Model
{
    use HasFactory;
    protected $fillable = [
        'prix',
        'proprietaire',
        'acheteur',
        'nom',
        'categorie',
        'dateOuverture',
        'dateFermeture',
        'vendu'
    ];

}
