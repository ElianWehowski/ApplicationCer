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
        $joursApres=random_int(2,20);
        return [
            'prix' => $this->faker->numberBetween(1,150),
            'proprietaire' => $this->faker->numberBetween(2,15),
            'nbEnchere' => $this->faker->numberBetween(2,15),
            'acheteur' => null,
            'nom' => $this->faker->text(10),
            'categorie' => $this->faker->numberBetween(2,15),
            'dateOuverture' => $this->faker->dateTimeBetween('-1 month', '-10 days'),
            'dateFermeture' => $this->faker->dateTimeBetween('+1 days', "+$joursApres days"),
            'vendu' => "0",
        ];
    }
}
