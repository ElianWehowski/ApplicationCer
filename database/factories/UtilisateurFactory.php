<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UtilisateurFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $nomFamille = $this->faker->lastName();
        $prenom =$this->faker->firstName();
        $login =  $prenom[0].strtolower($nomFamille) ;
        return [
            'nom' => ucfirst($nomFamille),
            'prenom' => $prenom,
            'login' =>ucfirst($login),
            'mdp' => Hash::make('password'),
            'type' => "utilisateur",
        ];
    }
}
