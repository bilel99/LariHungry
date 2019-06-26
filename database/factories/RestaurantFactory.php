<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use App\Restaurant;
use Faker\Generator as Faker;

$factory->define(Restaurant::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'ville_id' => 1,
        'title' => $faker->title,
        'description' => $faker->text,
        'adress' => $faker->address,
        'price' => $faker->numberBetween(4, 98)
    ];
});
