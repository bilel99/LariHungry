<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/
$factory->define(User::class, function (Faker $faker) {
    return [
        'media_id' => null,
        'name' => $faker->name,
        'firstname' => $faker->firstName,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => bcrypt('secret'),
        'roles' => serialize('ROLE_USER'),
        'is_active' => $faker->boolean,
        'remember_token' => Str::random(10),
    ];
});
