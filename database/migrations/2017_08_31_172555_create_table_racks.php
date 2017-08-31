<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRacks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('racks', function (Blueprint $table){

            $table->increments('id');
            $table->timestamps();
            $table->string('name', 10);
            $table->integer('local_id')->unsigned();
            $table->foreign('local_id')->references('id')->on('local');
            $table->integer('u');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('racks');
    }
}
