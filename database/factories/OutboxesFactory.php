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
        'channel_id' => '1', //$faker->numberBetween(1,1),
        'contact_id' => '20001', //$faker->numberBetween(1,1),
        'user_id' => $faker->numberBetween(1,4),

        
 

    ];
});
