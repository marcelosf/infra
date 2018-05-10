<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Infra\Entities\Devices\Stack;

class StackCsvTableSeeder extends Seeder
{
    private $csvFile;

    private $csvDelimiter;

    private $rowBuffer;

    private $stack;

    public function __construct(Stack $stack)
    {

        $this->stack = $stack;

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

            $this->createStack($data);

        }

    }

    private function createStack ($data)
    {

        $stack = [

            'hostname' => $data[5],

            'rack_id' => $this->getRackId($data[13]),

            'created_at' => now(),
        ];

        $this->stack->firstOrCreate(['hostname' => $stack['hostname']], $stack);

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

        $truncateAllowed = env('TRUNCATE_SEED');

        if ($truncateAllowed) {

            DB::statement("SET FOREIGN_KEY_CHECKS=0;");

            DB::table('stacks')->truncate();

            DB::statement("SET FOREIGN_KEY_CHECKS=1;");

        }

    }

}
