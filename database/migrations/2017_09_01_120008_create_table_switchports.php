<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSwitchports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('switchports', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('port');
            $table->boolean('is_poe');
            $table->boolean('poe_status');
            $table->integer('vlan');
            $table->integer('switch_id')->unsigned();
            $table->foreign('switch_id')->references('id')->on('switches');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('switchports');
    }
}
