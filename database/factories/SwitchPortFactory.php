<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

$factory->define(\Infra\Model\Devices\SwitchPorts::class, function (Faker $faker) {

    $min_switch = DB::table('switches')->min('id');
    $max_switch = DB::table('switches')->max('id');

    $max_patch = DB::table('ppanel')->max('id');
    $min_patch = DB::table('ppanel')->min('id');

    return [

        'port' => $faker->randomNumber(2),
        'is_poe' => $faker->boolean(50),
        'poe_status' => $faker->boolean(50),
        'vlan' => $faker->randomNumber(2),
        'switch_id' => $faker->numberBetween($min_switch, $max_switch),
        'ppanel_id' => $faker->unique()->numberBetween($min_patch, $max_patch)


    ];
});
