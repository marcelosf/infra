<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;


$factory->define(\Infra\Model\Devices\Switches::class, function (Faker $faker) {

    $min_stack = DB::table('stack')->min('id');
    $max_stack = DB::table('stack')->max('id');

    return [

        'hostname' => $faker->name('female'),
        'ip' => $faker->ipv4,
        'num_ports' => $faker->randomNumber(2),
        'brand' => $faker->title,
        'register' => $faker->randomNumber(4),
        'stack' => $faker->randomLetter,
        'stack_id' => $faker->numberBetween($min_stack, $max_stack)

    ];
});
