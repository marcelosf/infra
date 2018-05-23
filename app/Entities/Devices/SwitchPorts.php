<?php

namespace Infra\Entities\Devices;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;


class SwitchPorts extends Model implements Transformable
{

    use TransformableTrait;


    protected $fillable = [

        'port',
        'is_poe',
        'poe_status',
        'vlan',
        'switch_id',
        'ppanel_id'

    ];

    protected $table = 'switchports';


    public function dswitch()
    {

        return $this->belongsTo('Infra\Entities\Devices\Switches', 'switch_id');

    }


    public function patch()
    {

        return $this->belongsTo('Infra\Entities\Infra\Patch', 'ppanel_id');

    }

}
