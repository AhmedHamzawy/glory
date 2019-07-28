<?php

use Faker\Generator as Faker;

$factory->define(App\Event::class, function (Faker $faker) {
    return [
        'title' => $faker->text(20) ,
        'url' => $faker->url,
        'start' => $faker->date,
        'end' => $faker->date,
    ];
});
