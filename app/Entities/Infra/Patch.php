<?php

namespace Infra\Entities\Infra;

use Illuminate\Database\Eloquent\Entities;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;


class Patch extends Model implements Transformable
{
    use TransformableTrait;

    
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
        
        return $this->belongsTo('Infra\Entities\Infra\Rack');
        
    }
    
    
    public function local()
    {
        
        return $this->belongsTo('Infra\Entities\Local\Local');
        
    }
    
    
    public function switchPort()
    {
        
        return $this->hasOne('Infra\Entities\Devices\SwitchPorts', 'ppanel_id');
        
    }
    
    
    public function voicePort()
    {
        
        return $this->hasMany('Infra\Entities\Infra\VoicePort', 'ppanel_id');
        
    }
    
}
