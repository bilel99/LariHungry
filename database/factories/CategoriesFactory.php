<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Categorie;
use App\Model;
use Faker\Generator as Faker;

$factory->define(Categorie::class, function (Faker $faker) {
    return [
        'title' => $faker->title
    ];
});
