<?php

use Faker\Generator as Faker;

$factory->define(App\Group::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'active' => true,
        'description' => $faker->sentence,
    ];
});
