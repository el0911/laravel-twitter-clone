<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\tweet;
use App\User;

$factory->define(tweet::class, function (Faker\Generator $faker) {
    return [
        'body' => $faker->realText(140),
    ];
});

$factory->define(User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'username' => str_random(15),
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});
