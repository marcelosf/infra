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

        $this->call(LocalTableSeeder::class);

        $this->call(RackTableSeeder::class);

        $this->call(PatchTableSeeder::class);

        $this->call(VoicePanelSeeder::class);

        $this->call(StackSeeder::class);

        $this->call(SwitchesSeeder::class);

        $this->call(SwitchPortSeeder::class);

        $this->call(VoicePortSeeder::class);

        $this->call(ConnectionSeeder::class);

        $this->call(PhoneSeeder::class);

    }
}
