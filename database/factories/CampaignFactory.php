<?php

use Faker\Generator as Faker;

$factory->define(App\Campaign::class, function (Faker $faker) {
    return [
        'name'=> $faker->name,
        'user_id' => 3,
    ];
});
