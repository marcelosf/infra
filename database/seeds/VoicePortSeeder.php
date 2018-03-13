<?php

use Illuminate\Database\Seeder;
use Infra\Model\Infra\VoicePort;
use Illuminate\Support\Facades\DB;
class VoicePortSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->truncate();

        factory(VoicePort::class, 50)->create();

    }

    private function truncate ()
    {

        DB::statement("SET FOREIGN_KEY_CHECKS=0;");

        DB::table('voiceports')->truncate();

        DB::statement("SET FOREIGN_KEY_CHECKS=1;");

    }
}
