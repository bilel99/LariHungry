<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVilleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('ville')) {
            Schema::create('ville', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('pays_id')->unsigned();
                $table->string('departement_code', 3)->nullable();
                $table->string('zipcode', 5);
                $table->string('insee', 5)->nullable();
                $table->string('article', 5)->nullable();
                $table->string('name', 255);
                $table->string('libelle', 255);
                $table->string('longitude', 255)->nullable();
                $table->string('latitude', 255)->nullable();
                $table->string('codex', 255)->nullable();
                $table->string('metaphone', 255)->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('ville');
    }
}
