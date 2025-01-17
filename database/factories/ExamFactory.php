<?php

use Faker\Generator as Faker;

$factory->define(App\Exam::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
        'name' => $faker->name,
        'mark' => $faker->randomFloat(2,1,3)
    ];
});
