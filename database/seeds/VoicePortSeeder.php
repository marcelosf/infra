<?php

use Illuminate\Database\Seeder;
use Infra\Model\Infra\VoicePort;

class VoicePortSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(VoicePort::class, 200)->create();

    }
}
