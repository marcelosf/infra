<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SwitchPortCsvTableSeeder extends Seeder
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

            if ($data[16] !== 'NULL') {

                echo 'Inserting: ' . $data[16] . "\n";

                DB::table('switchports')->insert([

                    'port' => $data[20],

                    'is_poe' => $this->isPoe($data),

                    'poe_status' => $this->isPoe($data),

                    'vlan' => $this->getVlan($data),

                    'switch_id' => $this->getSwitchId($data),

                    'ppanel_id' => $this->getPpanelId($data),

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

    private function getSwitchId ($data)
    {

        if ($data[6]) {

            return DB::table('switches')->where('hostname', '=', $data[16])->pluck('id')[0];

        }

        return null;

    }

    private function getPpanelId ($data)
    {

        if ($data[6]) {

            return DB::table('ppanel')->where('reference', '=', $data[6])->pluck('id')[0];

        }

        return null;

    }

    private function getVlan($data) {

        if ($data[24]) {

            return $data[24];

        }

        if ($data[22] == 1) {

            return '50, 100, 101, 115';

        }

        if ($data[23] == 1) {

            return '12';

        }

        return null;

    }

    private function isPoe ($data)
    {

        if ($data[22] === 0 || $data[23] === 0) {

            return 0;

        }

        return 1;

    }

    private function truncate ()
    {

        DB::statement("SET FOREIGN_KEY_CHECKS=0;");

        DB::table('switchports')->truncate();

        DB::statement("SET FOREIGN_KEY_CHECKS=1;");

    }
}
