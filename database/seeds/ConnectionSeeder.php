<?php

use Illuminate\Database\Seeder;
use Infra\Model\Infra\Connections;

class ConnectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(Connections::class, 100)->create();

    }
}
