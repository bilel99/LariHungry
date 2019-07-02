<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurant_media', function (Blueprint $table) {
            $table->integer('restaurant_id')->nullable()->unsigned()->index();
            $table->integer('media_id')->nullable()->unsigned()->index();

            // Foreign - key
            $table->foreign('restaurant_id')
                ->references('id')->on('restaurant')
                ->onDelete('cascade');
            $table->foreign('media_id')
                ->references('id')->on('media')
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
        Schema::dropIfExists('restaurant_media');
    }
}
