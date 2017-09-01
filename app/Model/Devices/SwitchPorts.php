<?php

namespace Infra\Model\Devices;

use Illuminate\Database\Eloquent\Model;

class SwitchPorts extends Model
{

    protected $fillable = [

        'port',
        'is_poe',
        'poe_status',
        'vlan',
        'switch_id',

    ];


    protected $table = 'switchports';


    public function dswitch()
    {

        return $this->belongsTo('Infra\Model\Devices\Switches');

    }

}
