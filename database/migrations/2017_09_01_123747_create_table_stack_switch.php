<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableStackSwitch extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stack_switch', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('stack_id')->unsigned();
            $table->foreign('stack_id')->references('id')->on('stack');
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

        echo get_class($this) . "\n";

        Schema::dropIfExists('stack_switch');
    }
}
