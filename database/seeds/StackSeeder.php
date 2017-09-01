<?php

use Illuminate\Database\Seeder;
use Infra\Model\Devices\Stack;

class StackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(Stack::class, 50)->create();

    }
}
