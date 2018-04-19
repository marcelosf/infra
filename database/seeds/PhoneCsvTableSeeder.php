<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Infra\Entities\Infra\VoicePort;

class PhoneCsvTableSeeder extends Seeder
{
    private $csvFile;

    private $csvDelimiter;

    private $voicePort;


    public function __construct(VoicePort $voicePort)
    {

        $this->voicePort = $voicePort;

        $this->csvFile = env('CSV_SEED_FILE');

        $this->csvDelimiter = ';';

    }

    public function run()
    {

        $this->truncate();

        $handle = $this->handle();

        while(($data = $this->dumpCsv($handle)) !== false)
        {

            if ($this->phoneConnected($data)) {

                $phone = [

                    'number' => $data[14],

                    'category' => 'empty'

                ];

                $this->setVoicePortId($data, $phone);

                $this->setSwitchPortId($data, $phone);

               DB::table('phones')->insert($phone); 

            }

        }

    }


    private function setVoicePortId ($data, $phone) 
    {

        if (!empty($data[15] && $data[15] !== 'NULL')) {

            $phone['voice_port_id'] = $this->getVoicePortId($data);

        }

    }

    private function setSwitchPortId ($data, $phone)
    {

        if (!empty($data[8] && $data[8] !== 'NULL'))
        {

            $phone['switch_port_id'] = $this->getSwitchPortId($data);

        }

    }

    private function phoneConnected ($data)
    {

        return $data[14] !== 'NULL' && !empty($data[14]);

    }

    private function handle ()
    {

        return fopen($this->csvFile, 'r');

    }

    private function dumpCsv ($handle)
    {

        return fgetcsv($handle, 10000, $this->csvDelimiter);

    }

    private function getVoicePortId ($data)
    {

        printf("central => %s, distribution: %s \n", $data[15], $data[16]);

        return $this->voicePort->where(['central' => $data[15], 'distribution' => $data[16]])->pluck('id')[0];

    }

    private function getSwitchPortId ($data)
    {

        $switch = DB::table('switches')->where('hostname', '=', $data[16])->pluck('id')[0];

        printf("SwitchId: %s", $switch);

        return DB::table('switchport')->where('switch_id', '=', $switch)->pluck('id')[0];

    }


    private function truncate ()
    {

        $truncateAllowed = env('TRUNCATE_SEED');

        if ($truncateAllowed) {

            DB::statement("SET FOREIGN_KEY_CHECKS=0;");

            DB::table('phones')->truncate();

            DB::statement("SET FOREIGN_KEY_CHECKS=1;");

        }

    }
}
