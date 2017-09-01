<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSwitchs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('switches', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('hostname', 100);
            $table->string('ip', 20);
            $table->integer('num_ports');
            $table->string('brand', 100);
            $table->string('register', 100);
            $table->string('stack', 10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('switches');
    }
}
