<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StackCsvTableSeeder extends Seeder
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

            $stack = [

                'hostname' => $data[5],

                'rack_id' => $this->getRackId($data[13]),

                'created_at' => now(),
            ];

            if ($this->rowNotExists($stack)) {

                DB::table('stack')->insert($stack);

                $this->bufferRow($stack);

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

        DB::table('stack')->truncate();

        DB::statement("SET FOREIGN_KEY_CHECKS=1;");

    }

}
