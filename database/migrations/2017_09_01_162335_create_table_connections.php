<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableConnections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('connections', function(Blueprint $table) {

            $table->integer('switch_port_id')->unsigned()->nullable();
            $table->foreign('switch_port_id')->references('id')->on('switchports');
            $table->integer('patch_port_id')->unsigned();
            $table->foreign('patch_port_id')->references('id')->on('ppanel');
            $table->integer('voice_port_id')->unsigned()->nullable;
            $table->foreign('voice_port_id')->references('id')->on('voiceports');
            $table->enum('resource', ['wireless', 'network', 'iptv', 'vvx', 'telephone']);

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        echo "CreateTableConnections \n";

        Schema::dropIfExists('connections');

    }
}
