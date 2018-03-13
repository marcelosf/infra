<?php

use Illuminate\Database\Seeder;

class VoicePanelCsvTableSeeder extends Seeder
{
    private $csvFile;

    private $csvDelimiter;


    public function __construct()
    {

        $this->csvFile = 'database/csv/list.csv';

        $this->csvDelimiter = ';';

    }

    public function run()
    {

        $this->truncate();

        $handle = $this->handle();

        while(($data = $this->dumpCsv($handle)) !== false)
        {

            if ($data[13] !== 'NULL') {

                DB::table('voicepanels')->insert([

                    'number' => $data[13],

                    'numports' => 48,

                    'rack_id' => $this->getRackId($data),

                    'created_at' => now(),
                ]);

            }

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
