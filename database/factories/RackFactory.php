<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;


$factory->define(\Infra\Model\Infra\Rack::class, function (Faker $faker) {

    $min_local = DB::table('local')->min('id');
    $max_local = DB::table('local')->max('id');

    return [

        'name' => $faker->randomLetter,
        'local' => $faker->numberBetween($min_local, $max_local),
        'u' => 48

    ];
});
