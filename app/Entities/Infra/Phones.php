<?php

namespace Infra\Entities\Infra;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;


class Phones extends Model implements Transformable
{
    use TransformableTrait;


    protected $fillable = [

        'number',
        'category',
        'voice_port_id',
        'switch_port_id',

    ];

    protected $table = 'phones';
    
    
    public function voicePort()
    {
        
        return $this->belongsTo('Infra\Entities\Infra\VoicePort');
        
    }
    
    
    public function switchPort()
    {
        
        return $this->belongsTo('Infra\Entities\Devices\SwitchPorts');
        
    }


}
