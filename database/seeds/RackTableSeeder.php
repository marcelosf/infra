<?php

use Illuminate\Database\Seeder;
use Infra\Model\Infra\Rack;


class RackTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(Rack::class, 12)->create();

    }
}
