<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Service;
use Faker\Generator as Faker;

$factory->define(Service::class, function (Faker $faker) {
    return [
    [
        'name' => 'FTP',
        'path' => '/usr/bin/ftp',
        'note' => 'Dịch vụ truyền file'
    ],
    [
        'name' => 'FTP 2',
        'path' => '/usr/bin/ftp 2',
        'note' => 'Dịch vụ truyền file'
    ],
    [
        'name' => 'FTP 3',
        'path' => '/usr/bin/ftp 3',
        'note' => 'Dịch vụ truyền file'
    ]

        
    ];
});
