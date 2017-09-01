<?php

namespace Infra\Model\Infra;

use Illuminate\Database\Eloquent\Model;

class VoicePanel extends Model
{

    protected $fillable = [

        'number',
        'numports',
        'rack_id'

    ];


    protected $table = 'voicepanels';


    public function rack()
    {

        return $this->belongsTo('Infra\Model\Infra\Rack');

    }

    public function ports()
    {

        return $this->hasMany('Infra\Model\Infra\VoicePorts');

    }

}
