<?php

use Faker\Generator as Faker;

$factory->define(Infra\Model\Local\Local::class, function (Faker $faker) {

    return [

        'build' => $faker->randomElement(['A', 'B', 'C', 'D', 'E', 'F', 'G', 'Principal', 'Adm']),

        'floor' => $faker->numberBetween(0, 2),

        'local' => $faker->numberBetween(101, 325)
    ];

});
