<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Company;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(Company::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'email' => $faker->companyEmail,
        'password' => Hash::make('remember'),
        'logo' => $faker->imageUrl($width = 150, $height = 48),
        'url' => $faker->url
    ];
});
