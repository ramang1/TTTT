<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Contact;
use Faker\Generator as Faker;

$factory->define(Contact::class, function (Faker $faker) {
    return [
        //
        'code' => $faker->unique()->name,

        'name' => $faker->unique()->name,
        'phone' => $faker->phoneNumber,
        'note' => $faker->text(20),
                
    ];
});
