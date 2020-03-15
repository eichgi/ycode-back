<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Website;
use Faker\Generator as Faker;

$factory->define(Website::class, function (Faker $faker) {
    $name = $faker->word;

    return [
        'name' => $name,
        'url' => "{$name}.example.com",
        'created_at' => now()->addMinutes($faker->randomNumber(2)),
    ];
});
