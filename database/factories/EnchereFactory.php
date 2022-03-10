<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EnchereFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $joursApres=random_int(1,3);
            return [
                'idObjet' =>  $this->faker->numberBetween(0,10),
                'idEncherisseur' => $this->faker->numberBetween(0,7),
                'prixEnchere' => $this->faker->numberBetween(0,200),
                'dateEnchere' => $this->faker->dateTimeBetween('+1 days', "+$joursApres days"),
            ];
        }
}
