<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Infra\Entities\Infra\VoicePort;

class VoicePortCsvTableSeeder extends Seeder
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

        // $this->truncate();

        $handle = $this->handle();

        $line = 1;

        while(($data = $this->dumpCsv($handle)) !== false)
        {

            if ($this->voicePortIsSet($data)) {

                printf("Line: %s | ", $line);

                $voicePort = [

                    'number' => $data[17],

                    'central' => $data[15],

                    'distribution' => $data[16],

                    'voicepanel_id' => $this->getVoicePanelId($data[17]),

                    'ppanel_id' => $this->getPpanelId($data)

                ];

                if (!$this->disconnected($data)) {

                    $query = ['voicepanel_id' => $voicePort['voicepanel_id'], 'number' => $voicePort['number']];

                    $this->voicePort->where($query)->update($voicePort);

                }

            }

            $line ++;

        }

    }

    private function disconnected ($data)
    {

        return $data[14] === 'NULL' || empty($data[8]);

    }

    private function handle ()
    {

        return fopen($this->csvFile, 'r');

    }

    private function dumpCsv ($handle)
    {

        return fgetcsv($handle, 10000, $this->csvDelimiter);

    }

    private function getVoicePanelId ($voicepanel)
    {

        $voicepanelNumber = $this->getVoiceNumber($voicepanel);

        printf("voicepanel => %s \n", $voicepanel);

        return DB::table('voicepanels')->where('number', '=', $voicepanelNumber)->pluck('id')[0];

    }

    private function getPpanelId ($data)
    {

        printf("data[3] => %s \n", $data[3]);

        return DB::table('ppanel')->where('reference', '=', $data[3])->pluck('id')[0];

    }

    private function getVoiceNumber ($data)
    {

        die(var_dump($data));

        $voicePortNumber = (integer)$data[17];

        return  ceil($voicePortNumber/50);

    }

    private function voicePortIsSet ($data) {

        $phone = ($data[14] !== 'NULL' && !empty($data[14]));

        $port = ($data[15] !== 'NULL' && !empty($data[15]));

        $port104 = ($data[16] !== 'NULL' && !empty($data[16]));

        $portRack = ($data[17] !== 'NULL' && !empty($data[17]));

        return ($phone && $port && $port104 && $portRack);

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
