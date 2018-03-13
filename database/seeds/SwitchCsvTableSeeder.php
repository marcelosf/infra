<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SwitchCsvTableSeeder extends Seeder
{

    private $csvFile;

    private $csvDelimiter;


    public function __construct()
    {

        $this->csvFile = 'database/csv/switches.csv';

        $this->csvDelimiter = ';';

    }

    public function run()
    {

        $this->truncate();

        $handle = $this->handle();

        while(($data = $this->dumpCsv($handle)) !== false)
        {

            if ($data[0] !== 'NULL') {

                DB::table('switches')->insert([

                    'hostname' => $data[1],

                    'ip' => $data[3],

                    'num_ports' => 48,

                    'brand' => 'HP5120-G',

                    'register' => $data[0],

                    'stack_id'     => $this->getStackId($data[1]),

                    'stack' => $this->getStack($data),

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

    private function getStack ($data)
    {

        $hostnameExploded = explode('_', $data[0]);

        return end($hostnameExploded);

    }

    private function getStackId ($stack)
    {

        return DB::table('stack')->where('hostname', '=', $stack)->pluck('id')[0];

    }

    private function truncate ()
    {

        DB::statement("SET FOREIGN_KEY_CHECKS=0;");

        DB::table('switches')->truncate();

        DB::statement("SET FOREIGN_KEY_CHECKS=1;");

    }

}
