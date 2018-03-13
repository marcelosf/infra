<?php

use Illuminate\Database\Seeder;
use Infra\Model\Devices\Stack;
use Illuminate\Support\Facades\DB;

class StackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->truncate();

        factory(Stack::class, 50)->create();

    }

    private function truncate ()
    {

        DB::statement("SET FOREIGN_KEY_CHECKS=0;");

        DB::table('stack')->truncate();

        DB::statement("SET FOREIGN_KEY_CHECKS=1;");

    }
}
