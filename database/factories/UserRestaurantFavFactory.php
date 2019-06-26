<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use App\UserRestaurantFav;
use Faker\Generator as Faker;

$factory->define(UserRestaurantFav::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'restaurant_id' => 1,
        'fav' => $faker->boolean,
    ];
});
