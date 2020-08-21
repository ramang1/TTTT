<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ChannelContact;
use Faker\Generator as Faker;

$factory->define(ChannelContact::class, function (Faker $faker) {
    return [
        //10 tuyen, 30 contact
        'channel_id' => $faker->numberBetween(1, 10),
        'contact_id' => $faker->numberBetween(1, 30),
        // 'note' => $faker->text(10),

                
    ];
});
