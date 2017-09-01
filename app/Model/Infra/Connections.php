<?php

namespace Infra\Model\Infra;

use Illuminate\Database\Eloquent\Model;

class Connections extends Model
{

    protected $fillable = [

        'switch_port_id',
        'patch_port_id',
        'voice_port_id',
        'resource',

    ];


    protected $table = 'connections';


    public function switchPort()
    {

        return $this->belongsTo('Infra\Model\Device\SwitchPorts');

    }


    public function patchPort()
    {

        return $this->belongsTo('Infra\Model\Infra\Patch');

    }


    public function voicePort()
    {

        return $this->belongsTo('Infra\Model\Infra\VoicePort');

    }


}
