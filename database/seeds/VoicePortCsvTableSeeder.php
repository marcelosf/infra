<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VoicePortCsvTableSeeder extends Seeder
{
    private $csvFile;

    private $csvDelimiter;


    public function __construct()
    {

        $this->csvFile = 'database/csv/mainList.csv';

        $this->csvDelimiter = ';';

    }

    public function run()
    {

        $this->truncate();

        $handle = $this->handle();

        $line = 0;

        while(($data = $this->dumpCsv($handle)) !== false)
        {

            echo $line . "\n";

            DB::table('voiceports')->insert([

                'number' => $data[16],

                'central' => $data[14],

                'distribution' => $data[15],

                'voicepanel_id' => $this->getVoicePanelId($data[13]),

                'ppanel_id' => $this->getPpanelId($data),

                'created_at' => now(),
            ]);

            $line ++;

        }

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

        return DB::table('ppanel')->were('patchPort', '=', $data[6])->pluck('id')[0];

    }

    private function truncate ()
    {

        DB::statement("SET FOREIGN_KEY_CHECKS=0;");

        DB::table('voiceports')->truncate();

        DB::statement("SET FOREIGN_KEY_CHECKS=1;");

    }

}
