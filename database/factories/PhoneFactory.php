<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

$factory->define(\Infra\Model\Infra\Phones::class, function (Faker $faker) {

    $min_switch_port = DB::table('switchports')->min('id');
    $max_switch_port = DB::table('switchports')->max('id');

    $min_voice_port = DB::table('voiceports')->min('id');
    $max_voice_port = DB::table('voiceports')->max('id');

    return [

        'number' => $faker->randomNumber(4),
        'category' => $faker->randomLetter,
        'voice_port_id' => $faker->numberBetween($min_voice_port, $max_voice_port),
        'switch_port' => $faker->numberBetween($min_switch_port, $max_switch_port),

    ];
});
