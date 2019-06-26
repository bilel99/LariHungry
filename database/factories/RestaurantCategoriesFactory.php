<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use App\Restaurant;
use Faker\Generator as Faker;

$factory->define(Restaurant::class, function (Faker $faker) {
    return [
        'restaurant_id' => 1,
        'categories_id' => 1
    ];
});
