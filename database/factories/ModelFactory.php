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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => str_random(30)
    ];
});

$factory->define(App\Thing::class, function (Faker\Generator $faker,$id) {
    return [
        'name' => $faker->name,
        'user_id' => $id,
        'desc' => $faker->sentence(),
        'filename' => $faker->imageUrl($width = 640, $height = 480)
    ];
});
