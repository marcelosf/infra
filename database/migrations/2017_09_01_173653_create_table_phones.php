<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePhones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phones', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('number', 10);
            $table->string('category', 10)->nullable();
            $table->integer('voice_port_id')->unsigned()->nullable();
            $table->foreign('voice_port_id')->references('id')->on('voiceports');
            $table->integer('switch_port')->unsigned()->nullable();
            $table->foreign('switch_port')->references('id')->on('switchports');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        echo "CreateTablePhones \n";

        Schema::dropIfExists('phones');
    }
}
