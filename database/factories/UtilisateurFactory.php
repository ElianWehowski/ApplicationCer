<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
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
        return [
            'nom' => $this->faker->name(),
            'prenom' => $this->faker->name(),
            'login' => $this->faker->name(),
            'mdp' => "toto",
            'type' => "utilisateur",
            'enchereEffectuee' =>$this->faker->numberBetween(0,200)
        ];
    }
}
