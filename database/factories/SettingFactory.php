<?php

use Faker\Generator as Faker;
use App\Country;

$factory->define(App\Setting::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'address' => $faker->address,
        'town' => $faker->state,
        'county' => $faker->city,
        'post_code' => $faker->postcode,
        'country' => Country::all()->random()->id,
        'telephone' => $faker->phoneNumber,
        'email' => $faker->email,
        'website' => $faker->domainName,
        'facebook' => 'facebook.com',
        'twitter' => 'twitter.com',
        'instagram' => 'instagram.com',
        'youtube' => 'youtube.com',
    ];
});
