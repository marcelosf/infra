<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->call(localCsvTableSeeder::class);

        $this->call(RackCsvTableSeeder::class);

        $this->call(PatchCsvTableSeeder::class);

        $this->call(VoicePanelCsvTableSeeder::class);

        $this->call(StackCsvTableSeeder::class);

        $this->call(SwitchCsvTableSeeder::class);

        $this->call(SwitchPortCsvTableSeeder::class);

        $this->call(VoicePortCsvTableSeeder::class);

        $this->call(PhoneCsvTableSeeder::class);

    }
}
