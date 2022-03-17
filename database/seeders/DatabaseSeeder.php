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
        Objet::factory(80)->create();
        User::factory(7)->create();
        Enchere::factory(30)->create();
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

    }
}
