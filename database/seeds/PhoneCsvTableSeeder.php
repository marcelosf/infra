<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PhoneCsvTableSeeder extends Seeder
{
    private $csvFile;

    private $csvDelimiter;


    public function __construct()
    {

        $this->csvFile = 'database/csv/rack.csv';

        $this->csvDelimiter = ';';

    }

    public function run()
    {

        $this->truncate();

        $handle = $this->handle();

        while(($data = $this->dumpCsv($handle)) !== false)
        {

            DB::table('phones')->insert([

                'number' => $data[11],

                'category' => 'empty',

                'voice_port_id' => $this->getVoicePortId($data),

                'switch_port_id' => $this->getswitchPortId($data),

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

    private function getVoicePortId ($data)
    {

        return DB::table('voiceport')->where(['central' => $data[14], 'distribution' => $data[15]])->pluck('id')[0];

    }

    private function getSwitchPortId ($data)
    {

        $switch = DB::table('switches')->where('hostname', '=', $data[16])->pluck('id')[0];

        return DB::table('switchport')->where('switch_id', '=', $switch)->pluck('id')[0];

    }


    private function truncate ()
    {

        DB::statement("SET FOREIGN_KEY_CHECKS=0;");

        DB::table('phones')->truncate();

        DB::statement("SET FOREIGN_KEY_CHECKS=1;");

    }
}
