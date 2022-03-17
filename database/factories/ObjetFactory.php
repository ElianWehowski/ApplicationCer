<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ObjetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $minApres=random_int(5,60);
        return [
            'prix' => $this->faker->numberBetween(1,1500),
            'idProprietaire' => $this->faker->numberBetween(1,7),
            'idCategorie' => $this->faker->numberBetween(1,13),
            'idAcheteur' => null,
            'nom' => $this->faker->text(10),
            'dateOuverture' => $this->faker->dateTimeBetween('-1 hour', '-10 minute'),
            'dateFermeture' => $this->faker->dateTimeBetween('+1 minute', "+$minApres minute"),
            'vendu' => "0",
        ];
    }
}
