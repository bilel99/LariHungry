<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('notes')) {
            Schema::create('notes', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('note', 255);
                $table->integer('user_id')->unsigned()->nullable();
                $table->integer('restaurant_id')->unsigned()->nullable();
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
        Schema::dropIfExists('notes');
    }
}
