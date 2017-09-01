<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableVoicepanel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('voicepanels', function(Blueprint $table){

            $table->increments('id');
            $table->timestamps();
            $table->integer('number');
            $table->integer('numports');
            $table->integer('rack_id')->unsigned();
            $table->foreign('rack_id')->references('id')->on('racks');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('voicepanels');

    }
}
