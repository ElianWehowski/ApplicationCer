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
        //Categorie::factory(15)->create();
        Objet::factory(80)->create();
        User::factory(7)->create();
        Enchere::factory(160)->create();


        // Users par défault
        User::factory(User::class)->create([
            'name' => 'aze',
            'email' => 'aze@aze.aze',
            'password' => bcrypt('aze'),
            'type' => "participant"
        ]);
        User::factory(User::class)->create([
            'name' => 'admin',
            'email' => 'admin@admin.admin',
            'password' => bcrypt('admin'),
            'type' => "admin"
        ]);
        // Catégories
        Categorie::factory(Categorie::class)->create(['libelle'=>'Électroménagers']);
        Categorie::factory(Categorie::class)->create(['libelle'=>'vacances']);
        Categorie::factory(Categorie::class)->create(['libelle'=>'emplois']);
        Categorie::factory(Categorie::class)->create(['libelle'=>'vehicules']);
        Categorie::factory(Categorie::class)->create(['libelle'=>'immobiliers']);
        Categorie::factory(Categorie::class)->create(['libelle'=>'modes']);
        Categorie::factory(Categorie::class)->create(['libelle'=>'maisons']);
        Categorie::factory(Categorie::class)->create(['libelle'=>'multimédias']);
        Categorie::factory(Categorie::class)->create(['libelle'=>'loisirs']);
        Categorie::factory(Categorie::class)->create(['libelle'=>'animaux']);
        Categorie::factory(Categorie::class)->create(['libelle'=>'matériels professionnel']);
        Categorie::factory(Categorie::class)->create(['libelle'=>'services']);
        Categorie::factory(Categorie::class)->create(['libelle'=>'divers']);
    }
}
