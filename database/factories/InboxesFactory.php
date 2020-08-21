<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Models\Inbox::class, function (Faker $faker) {
    return [
        //
        'hash' =>$faker->sha256,
        'name' => $faker->unique()->firstName,
       
        'path' => $faker->text(20),

        'size' => $faker->numberBetween(100,10000),
        'type' => $faker->numberBetween(1,3),
        'contact_id' => $faker->numberBetween(1,10),
        'user_id' => $faker->numberBetween(1,6),
        
        


    ];
});
