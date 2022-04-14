<?php

namespace Tests\Browser;

use App\Models\Objet;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->browse(function (Browser $browser) {
            $ValeurASupprimer =5;

            $browser->visit('/login')
                ->type('email','admin@admin.admin')
                ->type('password','admin')
                ->press('Connexion')
                ->assertPathIs('/')
                ->assertSee("Résultats : 80")
                ->press("supprimer-$ValeurASupprimer")
                ->assertPathIs('/objet')
                ->assertSee("Résultats : 79");
        });
    }
}
