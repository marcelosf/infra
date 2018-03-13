<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RackCsvTableSeeder extends Seeder
{

    private $csvFile;

    private $csvDelimiter;


    public function __construct()
    {

        $this->csvFile = 'database/csv/rack.csv';

        $this->csvDelimiter = ';';

    }

    public function run()
    {

        $this->truncate();

        $handle = $this->handle();

        while(($data = $this->dumpCsv($handle)) !== false)
        {

            $localId = $this->getLocalId($data);

            DB::table('racks')->insert([

                'name' => $data[4],

                'local_id' => $localId,

                'u' => $data[3],

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

        return fgetcsv($handle, 10000, $this->csvDelimiter);

    }

    private function getLocalId ($local)
    {

        return DB::table('local')

            ->where(['build' => $local[0], 'floor' => $local[1], 'local' => $local[2]])

            ->pluck('id')[0];

    }

    private function truncate ()
    {

        DB::statement("SET FOREIGN_KEY_CHECKS=0;");

        DB::table('racks')->truncate();

        DB::statement("SET FOREIGN_KEY_CHECKS=1;");

    }

}
