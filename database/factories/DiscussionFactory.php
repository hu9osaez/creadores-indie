<?php

use Faker\Generator as Faker;

$factory->define(CreadoresIndie\Models\Discussion::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'body' => $faker->paragraph
    ];
});
