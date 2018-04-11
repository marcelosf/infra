<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PatchCsvTableSeeder extends Seeder
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

            $patch = [

                'reference' => $data[3],

                'number' => (integer)$this->getPatchInformation($data)[1],

                'port' => $this->getPatchInformation($data)[2],

                'rack_id' => $this->getRackId($data[13]),

                'local_id' => $this->getLocalId($data),

                'resource' => $this->getResource($data),

                'created_at' => now(),

            ];

            if ($this->rowNotExists($patch)) {

                DB::table('ppanel')->insert($patch);

                $this->rowBuffer[] = $patch;

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

    private function getLocalId ($local)
    {

        return DB::table('local')

            ->where(['build' => $local[0], 'floor' => $local[1], 'local' => $local[2]])

            ->pluck('id')[0];

    }

    private function getPatchInformation ($data)
    {

        return explode('-', $data[3]);

    }

    private function getRackId ($rack)
    {

        return DB::table('racks')->where('name', '=', $rack)->pluck('id')[0];

    }


    private function rowNotExists ($data)
    {

        return !in_array($data, $this->rowBuffer);

    }


    private function getResource ($data)
    {

        $resource = 'network';

        if (($data[9] === 'S') || ($data[9] === 1)) {

            $resource = 'wireless';

        }

        if (($data[10] === 'S') || ($data[10] === 1)) {

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
