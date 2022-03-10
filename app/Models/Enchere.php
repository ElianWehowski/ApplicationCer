<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enchere extends Model
{
    use HasFactory;
    protected $fillable = ['prixEnchere','idObjet','idProprietaire'];

}
