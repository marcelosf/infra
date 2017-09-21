<?php

namespace Infra\Model\Infra;

use Illuminate\Database\Eloquent\Model;

class VoicePort extends Model
{

    protected $fillable = [

        'number',
        'central',
        'distribution',
        'voicepanel_id',

    ];


    protected $table = 'voiceports';


    public function voicePanel()
    {

        return $this->belongsTo('Infra\Model\Infra\VoicePanel');

    }

    public function patch() {

        return $this->belongsTo('Infra\Model\Infra\Patch');

    }

}
