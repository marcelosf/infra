<?php

use Illuminate\Database\Seeder;
use Infra\Entities\Local\Local;
use Illuminate\Support\Facades\DB;

class localCsvTableSeeder extends Seeder
{

    private $csvFile;

    private $csvDelimiter;

    private $rowBuffer;

    private $local;


    public function __construct(Local $local)
    {

        $this->local = $local;

        $this->csvFile = env('CSV_SEED_FILE');

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

        $local = $this->local->firstOrCreate([

            'build' => $data[0],

            'floor' => $data[1],

            'local' => $data[2],

        ]);

        print_r($local . "\n");

    }

    private function createRackLocal ($data)
    {

        $rackLocal = $this->getRackLocal($data);

        $this->local->firstOrCreate([

            'build' => $rackLocal['build'],

            'floor' => $rackLocal['floor'],

            'local' => $rackLocal['local']
        ]);

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
