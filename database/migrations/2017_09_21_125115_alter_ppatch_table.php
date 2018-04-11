<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPpatchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('ppanel', function (Blueprint $table){

            $table->string('resource', 15);

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        echo "AlterPpatchTable \n";

        Schema::table('ppanel', function (Blueprint $table){

            $table->dropColumn(['resource']);

        });
    }
}
