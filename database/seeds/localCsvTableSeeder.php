<?php

use Illuminate\Database\Seeder;

class localCsvTableSeeder extends Seeder
{

    private $csvFile;

    private $csvDelimiter;


    public function __construct()
    {

        $this->csvFile = 'database/csv/local.csv';

        $this->csvDelimiter = ';';

    }

    public function run()
    {

        $handle = $this->handle();

        while(($data = $this->dumpCsv($handle)) !== false)
        {

            DB::table('local')->insert([

                'build' => $data[2],

                'floor' => $data[1],

                'local' => $data[0],

                'created_at' => now(),
            ]);

        }

    }

    private function handle ()
    {

        return fopen($this->csvFile, 'r');

    }

    private function dumpCsv ($handle)
    {

        return fgetcsv($handle, 1000, $this->csvDelimiter);

    }

}
