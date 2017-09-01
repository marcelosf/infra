<?php

namespace Infra\Model\Infra;

use Illuminate\Database\Eloquent\Model;

class Rack extends Model
{

    protected $fillable = [

        'name',
        'local_id',
        'u'

    ];

    protected $table = 'racks';


    public function local()
    {

        return $this->belongsTo('Infra\Model\Local\Local');

    }

    public function patchs()
    {

        return $this->hasMany('Infra\Model\Infra\Patch');

    }

    public function voicePanels()
    {

        return $this->hasMany('Infra\Model\Infra\VoicePanel');

    }

}
