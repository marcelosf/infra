<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Infra\Entities\Infra\VoicePanel;
use Infra\Events\VoicepanelCreated;

class VoicePanelCsvTableSeeder extends Seeder
{
    private $csvFile;

    private $csvDelimiter;

    private $rowBuffer;

    private $voicePanel;

    public function __construct(VoicePanel $voicePanel)
    {

        $this->voicePanel = $voicePanel;

        $this->csvFile = env('CSV_SEED_FILE');

        $this->csvDelimiter = ';';

        $this->rowBuffer = [];


    }

    public function run()
    {

        $this->truncate();

        $handle = $this->handle();

        while(($data = $this->dumpCsv($handle)) !== false)
        {

            $this->createVoicePanel($data);

        }

    }

    private function createVoicePanel ($data)
    {

        if ($data[13] !== 'NULL') {

            $voice = [

                'number' => $this->getVoiceNumber($data),

                'numports' => 48,

                'rack_id' => $this->getRackId($data[13]),

                'created_at' => now(),
            ];

            $newVoicePanel = $this->voicePanel->firstOrCreate(['number' => $voice['number']], $voice);

            event(new VoicepanelCreated($newVoicePanel));   

        }

    }

    private function getVoiceNumber ($data)
    {

        $voicePortNumber = (integer)$data[17];

        return  (string)ceil($voicePortNumber/50);

    }

    private function handle ()
    {

        return fopen($this->csvFile, 'r');

    }

    private function dumpCsv ($handle)
    {

        return fgetcsv($handle, 10000, $this->csvDelimiter);

    }

    private function getRackId ($rack)
    {

        return DB::table('racks')->where('name', '=', $rack)->pluck('id')[0];

    }

    private function truncate ()
    {

        $truncateAllowed = env('TRUNCATE_SEED');

        if ($truncateAllowed) {

            DB::statement("SET FOREIGN_KEY_CHECKS=0;");

            DB::table('voicepanels')->truncate();

            DB::table('voiceports')->truncate();

            DB::statement("SET FOREIGN_KEY_CHECKS=1;");

        }

    }
}
