<?php

use Faker\Generator as Faker;

$factory->define(App\Release::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(),
        'guid' => str_random(32),
        'category_id' => App\Category::inRandomOrder()->first()->id,
    ];
});
