<?php

namespace Infra\Model\Devices;

use Illuminate\Database\Eloquent\Model;

class Stack extends Model
{

    protected $fillable = [

        'hostname',
        'rack_id',

    ];

    protected $table = 'stacks';


    public function rack()
    {

        return $this->belongsTo('Infra\Model\Infra\Rack');

    }

    public function switches()
    {

        return $this->hasMany('Infra\Model\Devices\Switches');

    }

}
