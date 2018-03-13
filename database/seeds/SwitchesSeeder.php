<?php

use Illuminate\Database\Seeder;
use Infra\Model\Devices\Switches;
use Illuminate\Support\Facades\DB;

class SwitchesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->truncate();

        factory(Switches::class, 30)->create();

    }

    private function truncate ()
    {

        DB::statement("SET FOREIGN_KEY_CHECKS=0;");

        DB::table('switches')->truncate();

        DB::statement("SET FOREIGN_KEY_CHECKS=1;");

    }
}
