<?php

namespace Infra\Model\Infra;

use Illuminate\Database\Eloquent\Model;

class Rack extends Model
{

    protected $fillable = [

        'name',
        'local',
        'u'

    ];

    protected $table = 'racks';


    public function local()
    {

        return $this->hasOne('Infra\Model\Local\Local');

    }

}
