<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;


$factory->define(\Infra\Model\Infra\Connections::class, function (Faker $faker) {

    $min_switch_port = DB::table('switchports')->min('id');
    $max_switch_port = DB::table('switchports')->max('id');

    $min_patch_port = DB::table('ppanel')->min('id');
    $max_patch_port = DB::table('ppanel')->max('id');

    $min_voice_port = DB::table('voiceports')->min('id');
    $max_voice_port = DB::table('voiceports')->max('id');

    return [

        'switch_port_id' => $faker->numberBetween($min_switch_port, $max_switch_port),
        'patch_port_id' => $faker->numberBetween($min_patch_port, $max_patch_port),
        'voice_port_id' => $faker->numberBetween($min_voice_port, $max_voice_port),
        'resource' => $faker->randomElement(['wireless', 'network', 'iptv', 'vvx', 'telephone']),

    ];
});
