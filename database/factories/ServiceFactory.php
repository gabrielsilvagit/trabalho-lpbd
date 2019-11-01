<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Service;
use Faker\Generator as Faker;

$factory->define(Service::class, function (Faker $faker) {
    $owner = factory(User::class)->create();
    return [
        'title' => $faker->jobTitle,
        'description' => $faker->catchPhrase,
        'price' => rand(0,1000),
        'user_id' => $owner->id
    ];
});
