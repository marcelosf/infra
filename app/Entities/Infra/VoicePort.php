<?php

namespace Infra\Entities\Infra;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class VoicePort extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        
        'number',
        'central',
        'distribution',
        'voicepanel_id',
    
    ];
    
    
    protected $table = 'voiceports';
    
    
    public function voicePanel()
    {
        
        return $this->belongsTo('Infra\Entities\Infra\VoicePanel');
        
    }
    
    
    public function patch()
    {
        
        return $this->belongsTo('Infra\Entities\Infra\Patch');
        
    }
    
}
