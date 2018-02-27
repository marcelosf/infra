<?php

namespace Infra\Entities\Infra;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class VoicePanel extends Model implements Transformable
{
    
    use TransformableTrait;

    protected $fillable = [

        'number',
        'numports',
        'rack_id',

    ];


    protected $table = 'voicepanels';
    
    
    public function rack()
    {
        
        return $this->belongsTo('Infra\Entities\Infra\Rack');
        
    }
    
    
    public function ports()
    {
        
        return $this->hasMany('Infra\Entities\Infra\VoicePorts');
        
    }


}
