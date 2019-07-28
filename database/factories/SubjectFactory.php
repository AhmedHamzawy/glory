<?php

use Faker\Generator as Faker;

$factory->define(App\Subject::class, function (Faker $faker) {
    return [
        'name' => $faker->text(20),
        'professor' => $faker->name,
        'assistant' => $faker->name,
        'description' => $faker->paragraph,
        'mark' => 100,
    ];
});
