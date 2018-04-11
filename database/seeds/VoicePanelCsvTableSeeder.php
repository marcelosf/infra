<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VoicePanelCsvTableSeeder extends Seeder
{
    private $csvFile;

    private $csvDelimiter;

    private $rowBuffer;

    public function __construct()
    {

        $this->csvFile = 'database/csv/mainList.csv';

        $this->csvDelimiter = ';';

        $this->rowBuffer = [];


    }

    public function run()
    {

        $this->truncate();

        $handle = $this->handle();

        while(($data = $this->dumpCsv($handle)) !== false)
        {

            if ($data[13] !== 'NULL') {

                $voice = [

                    'number' => $this->getVoiceNumber($data),

                    'numports' => 48,

                    'rack_id' => $this->getRackId($data[13]),

                    'created_at' => now(),
                ];

                if ($this->rowNotExists($voice)) {

                    DB::table('voicepanels')->insert($voice);

                    $this->bufferRow($voice);

                }

            }

        }

    }

    private function rowNotExists ($data)
    {

        return !in_array($data, $this->rowBuffer);

    }

    private function bufferRow ($row)
    {

        $this->rowBuffer[] = $row;

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

        DB::statement("SET FOREIGN_KEY_CHECKS=0;");

        DB::table('voicepanels')->truncate();

        DB::statement("SET FOREIGN_KEY_CHECKS=1;");

    }
}
