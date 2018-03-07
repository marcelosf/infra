<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PatchView extends Migration
{

    public function up()
    {

        DB::statement("
       
            CREATE VIEW patchList as (
        
            select 
                l.build build,
                l.floor floor,
                l.local local,
                pp.reference patchPort,
                stack.hostname switchHostname,
                switches.ip switchPortIp,
                switches.hostname switch,
                pp.resource resource,
                sp.vlan switchPortVlan,
                sp.port switchPort,
                concat(rlocal.build, '-', rlocal.local) as rackLocal,
                rack.name rack
            
            from ppanel as pp
            inner join local as l on l.id = pp.local_id
            inner join switchports as sp on sp.ppanel_id = pp.id
            inner join switches as switches on switches.id = sp.switch_id
            inner join stack as stack on stack.id = switches.stack_id
            inner join racks as rack on rack.id = pp.rack_id
            inner join local as rlocal on rlocal.id = rack.local_id )
        
        ");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        DB::statement("DROP VIEW IF EXISTS ");

    }
}
