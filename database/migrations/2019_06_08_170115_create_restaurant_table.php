<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('restaurant')) {
            Schema::create('restaurant', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('title', 255);
                $table->longText('description');
                $table->string('adress', 255);
                $table->string('price', 255);
                $table->integer('user_id')->unsigned()->nullable();
                $table->integer('ville_id')->unsigned()->nullable();
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
        Schema::dropIfExists('restaurant');
    }
}
