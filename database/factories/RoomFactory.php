<?php

use Faker\Generator as Faker;

$factory->define(App\Room::class, function (Faker $faker) {
    return [
       'name' => $faker->name,   
       'no' => $faker->numberBetween(0 , 194),
    ];
});
