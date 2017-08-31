<?php

use Illuminate\Database\Seeder;
use Infra\Model\Local\Local;

class LocalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(Local::class, 10)->create();

    }
}
