<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Contact;
use App\Model;
use Faker\Generator as Faker;

$factory->define(Contact::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'firstname' => $faker->firstName,
        'email' => $faker->unique()->safeEmail,
        'sujet' => $faker->paragraph,
        'number_phone' => '0612345678',
        'restaurant' => null,
        'text' => $faker->text,
        'done' => $faker->boolean
    ];
});
