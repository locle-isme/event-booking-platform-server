<?php

use App\Speaker;
use Faker\Generator as Faker;

$factory->define(Speaker::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->unique()->name,
        'birthday' => $faker->dateTimeBetween('1968-01-01', '2000-12-31')
            ->format('Y-m-d'),
        'avatar' => 'images/avatar/1618301611.jpg',
        'social_linking' => 'https://twitter.com/LocLe_isme',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
    ];
});
