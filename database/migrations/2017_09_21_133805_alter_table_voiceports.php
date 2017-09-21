<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableVoiceports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('voiceports', function (Blueprint $table) {

            $table->integer('ppanel_id')->unsigned();
            $table->foreign('ppanel_id')->references('id')->on('ppanel');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('voiceports', function(Blueprint $table) {

            $table->dropForeign('ppanel_id');

        });

    }
}
