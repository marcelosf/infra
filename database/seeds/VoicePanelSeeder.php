<?php

use Illuminate\Database\Seeder;
use Infra\Model\Infra\VoicePanel;
use Illuminate\Support\Facades\DB;
class VoicePanelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->truncate();

        return factory(VoicePanel::class, 100)->create();

    }

    private function truncate ()
    {

        DB::statement("SET FOREIGN_KEY_CHECKS=0;");

        DB::table('voicepanels')->truncate();

        DB::statement("SET FOREIGN_KEY_CHECKS=1;");

    }
}
