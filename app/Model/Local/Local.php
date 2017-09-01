<?php

namespace Infra\Model\Local;

use Illuminate\Database\Eloquent\Model;

class Local extends Model
{

    protected $fillable = [

        'build',
        'floor',
        'local',

    ];

    protected $table = 'local';


    public function racks()
    {

        return $this->hasMany('Infra\Model\Infra\Rack');

    }

    public function patchs()
    {

        return $this->hasMany('Infra\Model\Infra\Patch');

    }

}
