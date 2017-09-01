<?php

use Illuminate\Database\Seeder;
use Infra\Model\Devices\Switches;

class SwitchesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(Switches::class, 30)->create();

    }
}
