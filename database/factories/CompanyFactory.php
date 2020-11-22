<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Company;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(Company::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->company,
        'email' => $faker->unique()->companyEmail,
        'password' => Hash::make('company'),
        'logo' => $faker->imageUrl($width = 150, $height = 48),
        'url' => $faker->url
    ];
});
