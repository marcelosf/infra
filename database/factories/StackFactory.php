<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;


$factory->define(Infra\Model\Devices\Stack::class, function (Faker $faker) {

    $min_rack = DB::table('racks')->min('id');
    $max_rack = DB::table('racks')->max('id');

    return [

        'hostname' => $faker->name('female'),
        'rack_id' => $faker->numberBetween($min_rack, $max_rack)

    ];
});
