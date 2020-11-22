<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Employee;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(Employee::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->email,
        'password' => Hash::make('employee'),
        'company_id' => mt_rand(1, 20)
    ];
});
