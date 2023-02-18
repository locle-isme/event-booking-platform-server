<?php

use App\Speaker;
use Faker\Generator as Faker;

$factory->define(Speaker::class, function (Faker $faker) {
    $organizerIds = \App\Organizer::query()->pluck('id')->toArray();
    return [
        'organizer_id' => $organizerIds[rand(0, count($organizerIds) - 1)],
        'name' => $faker->unique()->name,
        'birthday' => $faker->dateTimeBetween('1968-01-01', '2000-12-31')
            ->format('Y-m-d'),
        'avatar' => $faker->image(),
        'social_linking' => $faker->url,
        'description' => $faker->text()
    ];
});
