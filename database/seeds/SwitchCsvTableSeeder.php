<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use \Infra\Events\SwitchCreated;
use Infra\Entities\Devices\Switches;

class SwitchCsvTableSeeder extends Seeder
{

    private $csvFile;

    private $csvDelimiter;

    private $rowBuffer;

    private $switch;

    public function __construct(Switches $switch)
    {

        $this->csvFile = 'database/csv/mainList.csv';

        $this->csvDelimiter = ';';

        $this->switch = $switch;

        $this->rowBuffer = [];

    }

    public function run()
    {

        $this->truncate();

        $handle = $this->handle();

        while(($data = $this->dumpCsv($handle)) !== false)
        {

            $switch = [

                'hostname' => $data[7],

                'ip' => $data[6],

                'num_ports' => 48,

                'brand' => 'HP5120-G',

                'register' => 'Preencher',

                'stack_id'     => $this->getStackId($data[5]),

                'stack' => $this->getStack($data),

                'created_at' => now(),
            ];

            if ($data[7] !== 'NULL' && ($this->rowNotExists($switch))) {

                $newSwitch = $this->switch->create($switch);

                event(new SwitchCreated($newSwitch));

                $this->bufferRow($switch);

            }

        }

    }

    private function rowNotExists ($row)
    {

        return !in_array($row, $this->rowBuffer);

    }

    private function bufferRow ($row)
    {

        $this->rowBuffer[] = $row;

    }

    private function getSwitch ($switch)
    {

        return $this->switch->where('hostname', '=', $switch['hostname']);

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

        $hostnameExploded = explode('_', $data[7]);

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
