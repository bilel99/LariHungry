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
        Schema::create('restaurant', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable()->unsigned()->index();
            $table->integer('ville_id')->nullable()->unsigned()->index();
            $table->string('title', 255);
            $table->longText('description');
            $table->string('adress', 255);
            $table->string('price', 255);

            // Foreign - key
            $table->foreign('user_id')
                ->references('id')->on('user');
            $table->foreign('ville_id')
                ->references('id')->on('ville');

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
        Schema::dropIfExists('restaurant');
    }
}
