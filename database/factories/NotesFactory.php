<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use App\Note;
use Faker\Generator as Faker;

$factory->define(Note::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'restaurant_id' => 1,
        'note' => $faker->numberBetween(0, 4)
    ];
});
