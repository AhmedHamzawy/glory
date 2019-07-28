<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'user_name' => $faker->name,
        'first_name' => $faker->firstName,
        'middle_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'gender' => $faker->boolean,
        'birthdate' => $faker->date,
        'age' => $faker->numberBetween(16 , 90),
        'telephone' => $faker->phoneNumber,
        'email' => $faker->unique()->safeEmail,
        'address' => $faker->address,   
        'street' => $faker->streetName,
        'town' => $faker->cityPrefix,
        'country' => $faker->numberBetween(0 , 194),
        'other' => $faker->text,         
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});
