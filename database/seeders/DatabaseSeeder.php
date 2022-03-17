<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Categorie;
use App\Models\Objet;
use App\Models\Enchere;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Categorie::factory(15)->create();
        User::factory(7)->create();
        Objet::factory(100)->create();
        Enchere::factory(30)->create();
        $ids = range(1, 10);
        Objet::factory()->count(30)->create()->each(function ($personnage) use($ids) {
            shuffle($ids);
            $personnage->albums()->attach(array_slice($ids, 0, rand(1, 5)));
        });
    }
}
