<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professionnels', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('Identifiant unique');
            $table->string('prenom', 25)->comment('Prénom du professionnel');
            $table->string('nom', 40)->comment('Nom du professionnel');
            $table->string('cp', 5)->comment('Code postal du professionnel');
            $table->string('ville', 38)->comment('Ville du professionnel');
            $table->string('telephone', 14)->comment('Téléphone du professionnel');
            $table->string('email', 191)->unique()->comment('Email du professionnel');
            $table->date('naissance')->comment('Date de naissance du professionnel');
            $table->boolean('formation')->comment('Activité de formation réalisee OUI/NON');
            $table->set('domaine', ['S', 'R', 'D'])->comment('Domaine de compétence du professionnel : Systèmes, Réseaux et/ou développement');
            $table->string('source', 191)->nullable()->comment('Source de la fiche du professionnel');
            $table->text('observation')->comment('Observation du professionnel');
            $table->timestamps();
            $table->unsignedBigInteger('metier_id')->comment('Identifiant du métier du professionnel');
            $table->foreign('metier_id')
                ->references('id')
                ->on('metiers')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('professionnels');
    }
};
