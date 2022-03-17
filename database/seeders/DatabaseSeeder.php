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
        Enchere::factory(30)->create();

        $ids = range(1, 10);
        Objet::factory()->count(100)->create()->each(function ($objets) use($ids) {
            shuffle($ids);
            $objets->categories()->attach(array_slice($ids, 0, rand(1, 5)));
        });
    }
}
