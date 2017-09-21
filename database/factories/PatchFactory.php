<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

$factory->define(\Infra\Model\Infra\Patch::class, function (Faker $faker) {

    $min_rack = DB::table('racks')->min('id');
    $max_rack = DB::table('racks')->max('id');

    $min_local = DB::table('local')->min('id');
    $max_local = DB::table('local')->max('id');

    return [

        'reference' => $faker->randomLetter,
        'number' => $faker->randomNumber(2),
        'port' => $faker->randomNumber(2),
        'rack_id' => $faker->numberBetween($min_rack, $max_rack),
        'local_id' => $faker->numberBetween($min_local, $max_local),
        'resource' => $faker->randomElement(['VVX', 'T', 'C', 'R'])

    ];
});
