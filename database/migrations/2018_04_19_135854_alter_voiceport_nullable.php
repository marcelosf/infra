<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterVoiceportNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::table('voiceports', function (Blueprint $table) {

            $table->integer('central')->nullable()->change();
            $table->integer('distribution')->nullable()->change();
            $table->integer('ppanel_id')->unsigned()->nullable()->change();
            
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
