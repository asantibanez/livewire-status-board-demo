<?php

/** @var Factory $factory */

use App\SalesOrder;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(SalesOrder::class, function (Faker $faker) {
    return [
        'client' => $faker->name,
        'status' => 'registered',
        'total' => $faker->randomFloat(2),
    ];
});
