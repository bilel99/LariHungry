<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurant_categories', function (Blueprint $table) {
            $table->integer('restaurant_id')->nullable()->unsigned()->index();
            $table->integer('categories_id')->nullable()->unsigned()->index();

            // Foreign - key
            $table->foreign('restaurant_id')
                ->references('id')->on('restaurant');
            $table->foreign('categories_id')
                ->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurant_categories');
    }
}
