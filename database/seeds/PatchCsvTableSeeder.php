<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PatchCsvTableSeeder extends Seeder
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

            DB::table('ppanel')->insert([

                'reference' => $data[6],
                'number' => (integer)$this->getPatchInformation($data)[1],
                'port' => $this->getPatchInformation($data)[2],
                'rack_id' => $this->getRackId($data[27]),
                'local_id' => $this->getLocalId($data),
                'resource' => $this->getResource($data),
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

            ->where(['build' => $local[0], 'floor' => $local[2], 'local' => $local[4]])

            ->pluck('id')[0];

    }

    private function getPatchInformation ($data)
    {

        return explode('-', $data[6]);

    }

    private function getRackId ($rack)
    {

        return DB::table('racks')->where('name', '=', $rack)->pluck('id')[0];

    }

    private function getResource ($data)
    {

        $resource = 'network';

        if ($data[22] === 1) {

            $resource = 'wireless';

        }

        if ($data[23] === 1) {

            $resource = 'camera';

        }

        return $resource;

    }

    private function truncate ()
    {

        DB::statement("SET FOREIGN_KEY_CHECKS=0;");

        DB::table('ppanel')->truncate();

        DB::statement("SET FOREIGN_KEY_CHECKS=1;");

    }

}
