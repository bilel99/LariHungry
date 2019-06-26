<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use App\Tag;
use Faker\Generator as Faker;

$factory->define(Tag::class, function (Faker $faker) {
    return [
        'tag' => $faker->name
    ];
});
