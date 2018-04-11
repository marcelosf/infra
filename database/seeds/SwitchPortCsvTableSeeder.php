<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SwitchPortCsvTableSeeder extends Seeder
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

//        $this->truncate();

        $handle = $this->handle();

        while(($data = $this->dumpCsv($handle)) !== false)
        {

            if (!$this->disconnected($data)) {

                $switchPort = [

                    'port' => $this->getPort($data),

                    'is_poe' => $this->isPoe($data),

                    'poe_status' => $this->isPoe($data),

                    'vlan' => $this->getVlan($data),

                    'switch_id' => $this->getSwitchId($data),

                    'ppanel_id' => $this->getPpanelId($data),

                    'created_at' => now(),
                ];

                if ($data[7] !== 'NULL' && ($this->rowNotExists($switchPort))) {

                    DB::table('switchports')->where(['switch_id' => $switchPort['switch_id'], 'port' => $switchPort['port']])
                        ->update($switchPort);

                    $this->bufferRow($switchPort);

                }

            }

        }

    }

    private function disconnected ($data)
    {

        return $data[8] === 'NULL' || empty($data[8]);

    }

    private function rowNotExists ($row)
    {

        return !in_array($row, $this->rowBuffer);

    }

    private function bufferRow ($row)
    {

        $this->rowBuffer[] = $row;

    }

    private function getPort ($data)
    {

        return preg_replace('/.*(\d.)/', '$1', $data[8]);

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

            return DB::table('switches')->where('hostname', '=', $data[7])->pluck('id')[0];

        }

        return null;

    }

    private function getPpanelId ($data)
    {

        if ($data[3]) {

            return DB::table('ppanel')->where('reference', '=', $data[3])->pluck('id')[0];

        }

        return null;

    }

    private function getVlan($data) {

        if ($data[11]) {

            return $data[11];

        }

        if ($data[9] == 'S') {

            return '50, 100, 101, 115';

        }

        if ($data[10] == 'S') {

            return '12';

        }

        return null;

    }

    private function isPoe ($data)
    {

        if ($data[9] !== 'S' || $data[10] !== 'S') {

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
