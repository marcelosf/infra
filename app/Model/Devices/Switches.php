<?php

namespace Infra\Model\Devices;

use Illuminate\Database\Eloquent\Model;

class Switches extends Model
{

    protected $fillable = [

        'hostname',
        'ip',
        'num_ports',
        'brand',
        'register',
        'stack'

    ];

    protected $table = 'switches';


    public function ports()
    {

        return $this->hasMany('Infra\Model\Devices\SwitchPorts');

    }


    public function stack()
    {

        return $this->belongsTo('Infra\Model\Devices\Stack');

    }

}
