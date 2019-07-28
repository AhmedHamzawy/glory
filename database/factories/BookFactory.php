<?php

use Faker\Generator as Faker;

$factory->define(App\Book::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
        'book' => $faker->title,
        'requested' => $faker->boolean,
        'borrowed' => $faker->boolean,

    ];
});
