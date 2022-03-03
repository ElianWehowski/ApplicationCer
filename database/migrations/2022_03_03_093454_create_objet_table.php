<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('objets', function (Blueprint $table) {
            $table->id('idObjet');
            $table->integer('prix');
            $table->integer('proprietaire');
            $table->integer('nbEnchere');
            $table->integer('acheteur')->nullable();
            $table->String('nom');
            $table->String('categorie');
            $table->date('dateOuverture');
            $table->date('dateFermeture');
            $table->boolean('vendu');
            $table->timestamps();
            $table->foreign('proprietaire')->references('idUtilisateur')->on('utilisateurs');
            $table->foreign('acheteur')->references('idUtilisateur')->on('utilisateurs');
            $table->foreign('categorie')->references('idCategorie')->on('categorie');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('objet');
    }
}
