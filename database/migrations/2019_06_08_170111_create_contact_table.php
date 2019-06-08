<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('contact')) {
            Schema::create('contact', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name', 50);
                $table->string('firstname', 50);
                $table->string('email', 255);
                $table->string('sujet', 255);
                $table->string('number_phone', 10)->nullable();
                $table->string('restaurant', 255)->nullable();
                $table->longText('text');
                $table->boolean('done')->nullable();
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
        Schema::dropIfExists('contact');
    }
}
