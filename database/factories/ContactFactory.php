<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Contact;
use Faker\Generator as Faker;

$factory->define(Contact::class, function (Faker $faker) {
    return [
        //
        'code' => $faker->unique()->numberBetween(1000, 99999),

        'name' => $faker->unique()->name,
        'phone' => $faker->phoneNumber,
        'note' => $faker->text(20),
                
    ];
});
