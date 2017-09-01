<?php

use Illuminate\Database\Seeder;
use Infra\Model\Infra\Phones;

class PhoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(Phones::class, 100)->create();

    }
}
