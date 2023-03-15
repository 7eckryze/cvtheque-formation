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
        Schema::create('competences', function (Blueprint $table) {
            //id() propose une rubrique id de type bigint de 20, UNSIGNED, auto-incrémenté, non nul et en clé primaire
            $table->id()->comment('Identifiant de la compétence');
            $table->string('intitule', 120)->comment('Intitulé de la compétence');
            $table->text('description')->comment('Description de la compétence');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('competences');
    }
};
