<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableStack extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stack', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('hostname', 50);
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

        echo get_class($this) . "\n";

        Schema::dropIfExists('stack');
    }
}
