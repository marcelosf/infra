<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Infra\Entities\Infra\Rack;

class RackCsvTableSeeder extends Seeder
{

    private $csvFile;

    private $csvDelimiter;

    private $rowBuffer;

    private $rack;


    public function __construct(Rack $rack)
    {

        $this->rack = $rack;

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

            $this->createRack($data);

        }

    }

    private function createRack ($data)
    {

        $localId = $this->getLocalId($data);

        $rack = [

            'name' => $data[13],

            'local_id' => $localId,

            'u' => 48,

            'created_at' => now(),
        ];

        $this->rack->firstOrCreate(['name' => $rack['name']], $rack);

    }

    private function handle ()
    {

        return fopen($this->csvFile, 'r');

    }

    private function dumpCsv ($handle)
    {

        return fgetcsv($handle, 10000, $this->csvDelimiter);

    }

    private function getLocalId ($data)
    {

        $local = $this->getRackLocal($data);

        echo $local['build'] . '-' . $local['local'] . "\n";

        return DB::table('local')

            ->where(['build' => $local['build'], 'local' => $local['local']])

            ->pluck('id')[0];

    }

    private function getRackLocal ($data)
    {

        $local = ['build' => '', 'local' => ''];

        $local['local'] = preg_replace('/(.*)(\d{3})/', '$2', $data[12]);

        $local['build'] = preg_replace('/(.*)(\d{3})/', '$1', $data[12]);

        if (empty($local['build'])) {

            $local['build'] = $data[0];

        }

        return $local;

    }

    private function truncate ()
    {

        $truncateAllowed = env('TRUNCATE_SEED');

        if ($truncateAllowed) {

            DB::statement("SET FOREIGN_KEY_CHECKS=0;");

            DB::table('racks')->truncate();

            DB::statement("SET FOREIGN_KEY_CHECKS=1;");

        }

    }

}
