<?php

use Faker\Generator as Faker;

$factory->define(App\Timetable::class, function (Faker $faker) {
    return [
        'name' => $faker->text(20),
    ];
});