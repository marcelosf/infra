<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixPatchListView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::statement("DROP VIEW patchList");

        DB::statement("
       
            CREATE VIEW patchList as (
        
            select
            
                distinct pp.reference patchPort,
                l.build build,
                l.floor floor,
                l.local local,
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
            left join switchports as sp on sp.ppanel_id = pp.id
            left join switches as switches on switches.id = sp.switch_id
            left join stacks as stack on stack.id = switches.stack_id
            inner join racks as rack on rack.id = pp.rack_id
            inner join local as rlocal on rlocal.id = rack.local_id
             
             order by patchPort
             
             )
        
        ");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW patchList");
    }

}
