<?php

use Illuminate\Database\Seeder;
use Infra\Model\Infra\VoicePanel;

class VoicePanelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        return factory(VoicePanel::class, 100)->create();

    }
}
