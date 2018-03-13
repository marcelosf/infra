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

        $this->truncate();

        factory(Patch::class, 200)->create();

    }

    private function truncate ()
    {

        DB::statement("SET FOREIGN_KEY_CHECKS=0;");

        DB::table('ppanel')->truncate();

        DB::statement("SET FOREIGN_KEY_CHECKS=1;");

    }
}
