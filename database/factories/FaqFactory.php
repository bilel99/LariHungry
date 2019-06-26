<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Faq;
use App\Model;
use Faker\Generator as Faker;

$factory->define(Faq::class, function (Faker $faker) {
    return [
        'question' => $faker->paragraph,
        'answer' => $faker->paragraph,
        'done' => $faker->boolean
    ];
});
