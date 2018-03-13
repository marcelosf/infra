<?php

use Illuminate\Database\Seeder;
use Infra\Model\Local\Local;
use Illuminate\Support\Facades\DB;

class LocalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->truncate();

        factory(Local::class, 10)->create();

    }

    private function truncate ()
    {

        DB::statement("SET FOREIGN_KEY_CHECKS=0;");

        DB::table('local')->truncate();

        DB::statement("SET FOREIGN_KEY_CHECKS=1;");

    }

}
