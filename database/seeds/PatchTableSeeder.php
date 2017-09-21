<?php

use Illuminate\Database\Seeder;
use Infra\Model\Infra\Patch;

class PatchTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(Patch::class, 200)->create();

    }
}
