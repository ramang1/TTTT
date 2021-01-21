<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Models\Outbox::class, function (Faker $faker) {
    return [
        //
        'hash' =>$faker->sha256,
        
        'name' => $faker->unique()->firstname(),
        'path' => $faker->text(20),


        'size' => $faker->numberBetween(100,10000),
        'type' => $faker->numberBetween(1,4),
        'channel_id' => $faker->numberBetween(1,20),
        'contact_id' => $faker->numberBetween(1,25),     
        'user_id' => $faker->numberBetween(1,10),

        
 

    ];
});
