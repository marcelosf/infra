<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class localCsvTableSeeder extends Seeder
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

            $this->createLocal($data);

            $this->createRackLocal($data);

        }

    }

    private function createLocal ($data)
    {

        if ($this->rowNotExist($data)) {

            DB::table('local')->insert([

                'build' => $data[0],

                'floor' => $data[1],

                'local' => $data[2],

                'created_at' => now(),
            ]);

            $this->rowBuffer[] = ['build' => $data[0], 'floor' => $data[1], 'local' => $data[2]];

        }

    }

    private function createRackLocal ($data)
    {

        $rackLocal = $this->getRackLocal($data);

        if ($this->rowNotExist([$rackLocal['build'], $rackLocal['floor'], $rackLocal['local']])) {

            DB::table('local')->insert([

                'build' => $rackLocal['build'],

                'floor' => $rackLocal['floor'],

                'local' => $rackLocal['local'],

                'created_at' => now(),
            ]);

            $this->rowBuffer[] = ['build' => $rackLocal['build'], 'floor' => $rackLocal['floor'], 'local' => $rackLocal['local']];

        }

    }

    private function getRackLocal ($data)
    {

        $local = ['build' => '', 'local' => ''];

        $local['local'] = preg_replace('/(.*)(\d{3})/', '$2', $data[12]);

        $local['build'] = preg_replace('/(.*)(\d{3})/', '$1', $data[12]);

        if (empty($local['build'])) {

            $local['build'] = $data[0];

        }

        $local['floor'] = (string)substr($local['local'], 0, 1) - 1;

        return $local;

    }

    private function handle ()
    {

        return fopen($this->csvFile, 'r');

    }

    private function dumpCsv ($handle)
    {

        return fgetcsv($handle, 1000, $this->csvDelimiter);

    }

    private function rowNotExist ($data)
    {

        $local = ['build' => $data[0], 'floor' => $data[1], 'local' => $data[2]];

        return  !in_array($local, $this->rowBuffer);

    }

    private function truncate ()
    {

        DB::statement("SET FOREIGN_KEY_CHECKS=0;");

        DB::table('local')->truncate();

        DB::statement("SET FOREIGN_KEY_CHECKS=1;");

    }

}
