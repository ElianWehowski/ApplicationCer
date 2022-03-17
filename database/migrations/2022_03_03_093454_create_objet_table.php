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
            $table->id();

            $table->integer('idCategorie');
            $table->integer('idAcheteur')->nullable();
            $table->integer('idProprietaire');
            $table->float('prix');

            $table->String('nom');

            $table->dateTime('dateOuverture');
            $table->dateTime('dateFermeture');

            $table->boolean('vendu');
            $table->timestamps();

            $table->foreign('idAcheteur')->references('idUtilisateur')->on('utilisateurs');
            $table->foreign('idProprietaire')->references('idUtilisateur')->on('utilisateurs');
            $table->foreign('idCategorie')->references('idCategorie')->on('categories');

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
