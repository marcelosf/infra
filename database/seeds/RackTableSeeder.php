<?php

use Illuminate\Database\Seeder;
use Infra\Model\Infra\Rack;
use Illuminate\Support\Facades\DB;

class RackTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

       $this->truncate();

       factory(Rack::class, 12)->create();

    }

    private function truncate ()
    {

        DB::statement("SET FOREIGN_KEY_CHECKS=0;");

        DB::table('racks')->truncate();

        DB::statement("SET FOREIGN_KEY_CHECKS=1;");

    }
}
