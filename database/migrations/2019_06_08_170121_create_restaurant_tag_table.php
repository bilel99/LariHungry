<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurant_tag', function (Blueprint $table) {
            $table->integer('restaurant_id')->nullable()->unsigned()->index();
            $table->integer('tag_id')->nullable()->unsigned()->index();

            // Foreign - key
            $table->foreign('restaurant_id')
                ->references('id')->on('restaurant')
                ->onDelete('cascade');
            $table->foreign('tag_id')
                ->references('id')->on('tag')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurant_tag');
    }
}
