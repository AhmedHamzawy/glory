<?php

use Faker\Generator as Faker;
use App\user;

$factory->define(App\Message::class, function (Faker $faker) {
    return [
        'from' => User::all()->random()->id,
        'to' => User::all()->random()->id,
        'message' => $faker->text
    ];
});
