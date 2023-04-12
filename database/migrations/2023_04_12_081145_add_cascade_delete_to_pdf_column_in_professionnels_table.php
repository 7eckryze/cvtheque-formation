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
        Schema::table('professionnels', function (Blueprint $table) {
            $table->unsignedBigInteger('pdf')->comment('CV du professionnel');
            $table->foreign('pdf')
                ->references('pdf')
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
        Schema::table('professionnels', function (Blueprint $table) {
            //
        });
    }
};
