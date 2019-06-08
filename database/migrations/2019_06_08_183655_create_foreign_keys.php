<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('media_id')
                ->references('id')->on('media');
        });
        Schema::table('ville', function (Blueprint $table) {
            $table->foreign('pays_id')
                ->references('id')->on('pays');
        });
        Schema::table('restaurant', function (Blueprint $table) {
            $table->foreign('users_id')
                ->references('id')->on('users');
            $table->foreign('ville_id')
                ->references('id')->on('ville');
        });
        Schema::table('notes', function (Blueprint $table) {
            $table->foreign('users_id')
                ->references('id')->on('users');
            $table->foreign('restaurant_id')
                ->references('id')->on('restaurant');
        });
        Schema::table('comments', function (Blueprint $table) {
            $table->foreign('users_id')
                ->references('id')->on('users');
            $table->foreign('restaurant_id')
                ->references('id')->on('restaurant');
        });
        Schema::table('users_restaurant_fav', function (Blueprint $table) {
            $table->foreign('users_id')
                ->references('id')->on('users');
            $table->foreign('restaurant_id')
                ->references('id')->on('restaurant');
        });
        Schema::table('restaurant_ville', function (Blueprint $table) {
            $table->foreign('restaurant_id')
                ->references('id')->on('restaurant');
            $table->foreign('categories_id')
                ->references('id')->on('categories');
        });
        Schema::table('restaurant_media', function (Blueprint $table) {
            $table->foreign('restaurant_id')
                ->references('id')->on('restaurant');
            $table->foreign('media_id')
                ->references('id')->on('media');
        });
        Schema::table('restaurant_tag', function (Blueprint $table) {
            $table->foreign('restaurant_id')
                ->references('id')->on('restaurant');
            $table->foreign('tag_id')
                ->references('id')->on('tag');
        });
        Schema::table('restaurant_ville', function (Blueprint $table) {
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

    }
}
