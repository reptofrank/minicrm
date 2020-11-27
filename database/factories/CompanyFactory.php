<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Company;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(Company::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->company,
        'logo' => $faker->imageUrl($width = 150, $height = 48),
        'url' => $faker->url,
        'user_id' => factory(App\User::class)->create(['role' => 'company', 'password' => Hash::make('company')])->id
    ];
});
