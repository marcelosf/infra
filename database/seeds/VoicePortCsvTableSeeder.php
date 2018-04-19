<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VoicePortCsvTableSeeder extends Seeder
{
    private $csvFile;

    private $csvDelimiter;


    public function __construct()
    {

        $this->csvFile = env('CSV_SEED_FILE');

        $this->csvDelimiter = ';';

    }

    public function run()
    {

        // $this->truncate();

        $handle = $this->handle();

        while(($data = $this->dumpCsv($handle)) !== false)
        {

            $voicePort = [

                'number' => $data[17],

                'central' => $data[15],

                'distribution' => $data[16],

                'voicepanel_id' => $this->getVoicePanelId($data[13]),

                'ppanel_id' => $this->getPpanelId($data)

            ];

            if (!$this->disconnected($data)) {

                DB::table('voiceports')->where(['voicepanel_id' => $voicePort['voicepanel_id'], 'number' => $voicePort['number']])
                
                    ->update($voicePort);

                printf("number => %s, voicepanel_id => %s", $voicePort['number'], $voicePort['voicepanel_id']);

            }

        }

    }

    private function disconnected ($data)
    {

        return $data[14] === 'NULL' || empty($data[8]);

    }

    private function handle ()
    {

        return fopen($this->csvFile, 'r');

    }

    private function dumpCsv ($handle)
    {

        return fgetcsv($handle, 10000, $this->csvDelimiter);

    }

    private function getVoicePanelId ($voicepanel)
    {

        return DB::table('voicepanels')->where('number', '=', $voicepanel)->pluck('id')[0];

    }

    private function getPpanelId ($data)
    {

        return DB::table('ppanel')->where('reference', '=', $data[3])->pluck('id')[0];

    }

    private function truncate ()
    {

        $truncateAllowed = env('TRUNCATE_SEED');

        if ($truncateAllowed) {

            DB::statement("SET FOREIGN_KEY_CHECKS=0;");

            DB::table('local')->truncate();

            DB::statement("SET FOREIGN_KEY_CHECKS=1;");

        }

    }

}
