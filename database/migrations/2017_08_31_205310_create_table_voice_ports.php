<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableVoicePorts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voiceports', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('number');
            $table->integer('central');
            $table->integer('distribution');
            $table->integer('voicepanel_id')->unsigned();
            $table->foreign('voicepanel_id')->references('id')->on('voicepanels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('voiceports');
    }
}
