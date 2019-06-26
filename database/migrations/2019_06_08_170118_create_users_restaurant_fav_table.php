<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersRestaurantFavTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_restaurant_fav', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable()->unsigned()->index();
            $table->integer('restaurant_id')->nullable()->unsigned()->index();
            $table->boolean('fav')->default(0)->nullable();

            // Foreign - key
            $table->foreign('user_id')
                ->references('id')->on('user');
            $table->foreign('restaurant_id')
                ->references('id')->on('restaurant');

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
        Schema::dropIfExists('users_restaurant_fav');
    }
}
