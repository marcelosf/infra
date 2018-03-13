<?php

use Illuminate\Database\Seeder;
use Infra\Model\Infra\Phones;
use Illuminate\Support\Facades\DB;

class PhoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->truncate();

        factory(Phones::class, 50)->create();

    }

    private function truncate ()
    {

        DB::statement("SET FOREIGN_KEY_CHECKS=0;");

        DB::table('phones')->truncate();

        DB::statement("SET FOREIGN_KEY_CHECKS=1;");

    }
}
