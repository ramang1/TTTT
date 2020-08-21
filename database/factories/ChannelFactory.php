<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Channel;
use Faker\Generator as Faker;

$factory->define(Channel::class, function (Faker $faker) {
    return [
        //
        'code' => $faker->name,
        'name' => $faker->name,
        'type' => $faker->numberBetween(1, 3),
        'note' => $faker->text(10),

                
    ];
});
