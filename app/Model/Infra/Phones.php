<?php

namespace Infra\Model\Infra;

use Illuminate\Database\Eloquent\Model;

class Phones extends Model
{

    protected $fillable = [

        'number',
        'category',
        'voice_port_id',
        'switch_port_id',

    ];

    protected $table = 'phones';


    public function voicePort()
    {

        return $this->belongsTo('Infra\Model\Infra\VoicePort');

    }

    public function switchPort()
    {

        return $this->belongsTo('Infra\Model\Devices\SwitchPorts');

    }

}
