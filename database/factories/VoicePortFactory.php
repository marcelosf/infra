<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;


$factory->define(\Infra\Model\Infra\VoicePort::class, function (Faker $faker) {

    $min_voice_panel = DB::table('voicepanels')->min('id');
    $max_voice_panel = DB::table('voicepanels')->max('id');

    return [

        'number' => $faker->randomNumber(2),
        'central' => $faker->randomNumber(2),
        'distribution' => $faker->randomNumber(2),
        'voicepanel_id' => $faker->numberBetween($min_voice_panel, $max_voice_panel),

    ];
});
