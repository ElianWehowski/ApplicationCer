<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEncheresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('encheres', function (Blueprint $table) {
            $table->integer('idObjet');
            $table->integer('idEncherisseur');
            $table->float('prixEnchere');
            $table->dateTime('dateEnchere');

            $table->foreign('idEncherisseur')->references('idUtilisateur')->on('utilisateurs');
            $table->foreign('idObjet')->references('idObjet')->on('objets');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('encheres');
    }
}
