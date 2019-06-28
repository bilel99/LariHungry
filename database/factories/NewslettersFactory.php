<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use App\Newsletters;
use Faker\Generator as Faker;

$factory->define(Newsletters::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->email,
        'status' => $faker->boolean
    ];
});
