<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;


$factory->define(\Infra\Model\Infra\VoicePort::class, function (Faker $faker) {

    $min_voice_panel = DB::table('voicepanels')->min('id');
    $max_voice_panel = DB::table('voicepanels')->max('id');

    $max_patch = DB::table('ppanel')->max('id');
    $min_patch = DB::table('ppanel')->min('id');

    return [

        'number' => $faker->randomNumber(2),
        'central' => $faker->randomNumber(2),
        'distribution' => $faker->randomNumber(2),
        'voicepanel_id' => $faker->numberBetween($min_voice_panel, $max_voice_panel),
        'ppanel_id' => $faker->unique()->numberBetween($min_patch, $max_patch)

    ];
});
