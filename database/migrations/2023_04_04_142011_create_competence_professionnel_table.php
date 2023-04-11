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
        Schema::create('competence_professionnel', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('competence_id')->comment('Identifiant de la compétence');
            $table->foreign('competence_id')
                ->references('id')
                ->on('competences')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('professionnel_id')->comment('Identifiant du professionnel');
            $table->foreign('professionnel_id')
                ->references('id')
                ->on('professionnels')
                ->onDelete('cascade')
                ->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('competence_professionnel');
    }
};
