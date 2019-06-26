<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('pays')) {
            Schema::create('pays', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('code');
                $table->string('alpha2', 50);
                $table->string('alpha3', 50);
                $table->string('nom_fr_fr', 50);
                $table->string('nom_en_gb', 50);
                $table->timestamps();
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
        //Schema::dropIfExists('pays');
    }
}
