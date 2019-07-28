<?php

use Faker\Generator as Faker;

$factory->define(App\Duration::class, function (Faker $faker) {
    return [
          
        'name' => $faker->name,
        
    ];
});
