<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePatchPanel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ppanel', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            //Patch Panel Port Reference. Ex: 01P-01-01
            $table->string('reference', 15);
            //Patch Panel Number
            $table->integer('number');
            //Patch Panel Port
            $table->integer('port');
            //Patch Panel Rack
            $table->integer('rack_id')->unsigned();
            $table->foreign('rack_id')->references('id')->on('racks');
            //Patch Panel Localization
            $table->integer('local_id')->unsigned();
            $table->foreign('local_id')->references('id')->on('local');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ppanel');
    }
}
