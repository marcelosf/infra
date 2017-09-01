<?php

use Illuminate\Database\Seeder;
use Infra\Model\Devices\SwitchPorts;

class SwitchPortSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(SwitchPorts::class, 100)->create();

    }
}
