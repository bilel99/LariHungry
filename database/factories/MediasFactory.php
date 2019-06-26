<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Media;
use App\Model;
use Faker\Generator as Faker;

$factory->define(Media::class, function (Faker $faker) {
    return [
        'type' => $faker->numberBetween(1, 2),
        'name' => $faker->name,
        'path' => $faker->imageUrl()
    ];
});
