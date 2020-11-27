<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Employee;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(Employee::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'user_id' => factory(App\User::class)->create(['role' => 'employee', 'password' => Hash::make('employee')])->id
    ];
});
