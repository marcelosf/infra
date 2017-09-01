<?php

use Faker\Generator as Faker;

$factory->define(\Infra\Model\Infra\VoicePanel::class, function (Faker $faker) {

    $min_rack = DB::table('racks')->min('id');
    $max_rack = DB::table('racks')->max('id');

    return [

        'number' => $faker->randomNumber(2),
        'numports' => $faker->randomNumber(2),
        'rack_id' => $faker->numberBetween($min_rack, $max_rack)

    ];
});
