<?php

namespace Infra\Model\Infra;

use Illuminate\Database\Eloquent\Model;

class Patch extends Model
{

    protected $fillable = [

        'reference',
        'number',
        'port',
        'rack_id',
        'local_id'

    ];


    protected $table = 'ppanel';


    public function rack()
    {

        return $this->belongsTo('Infra\Model\Infra\Rack');

    }


    public function local()
    {

        return $this->belongsTo('Infra\Model\Local\Local');

    }

}
