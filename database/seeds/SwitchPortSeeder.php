<?php

use Illuminate\Database\Seeder;
use Infra\Model\Devices\SwitchPorts;
use Illuminate\Support\Facades\DB;
class SwitchPortSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->truncate();

        factory(SwitchPorts::class, 100)->create();

    }

    private function truncate ()
    {

        DB::statement("SET FOREIGN_KEY_CHECKS=0;");

        DB::table('switchports')->truncate();

        DB::statement("SET FOREIGN_KEY_CHECKS=1;");

    }
}
