<?php

namespace Infra\Entities\Devices;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;


class Switches extends Model implements Transformable
{

    use TransformableTrait;


    protected $fillable = [

        'hostname',
        'ip',
        'num_ports',
        'brand',
        'register',
        'stack',
        'stack_id'

    ];

    protected $table = 'switches';


    public function ports()
    {

        return $this->hasMany('Infra\Entities\Devices\SwitchPorts');

    }

    public function stack()
    {

        return $this->belongsTo('Infra\Entities\Devices\Stack');

    }

}
