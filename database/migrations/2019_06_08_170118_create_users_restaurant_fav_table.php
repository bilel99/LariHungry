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
        if (!Schema::hasTable('users_restaurant_fav')) {
            Schema::create('users_restaurant_fav', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('users_id')->unsigned()->nullable();
                $table->integer('restaurant_id')->unsigned()->nullable();
                $table->boolean('fav')->default(0)->nullable();
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
        Schema::dropIfExists('users_restaurant_fav');
    }
}
