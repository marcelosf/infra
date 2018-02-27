<?php

namespace Infra\Entities\Infra;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;


class Rack extends Model implements Transformable
{

    use TransformableTrait;


    protected $fillable = [

        'name',
        'local_id',
        'u'

    ];


    protected $table = 'racks';
    
    
    public function local()
    {
        
        return $this->belongsTo('Infra\Entities\Local\Local');
        
    }
    
    
    public function patchs()
    {
        
        return $this->hasMany('Infra\Entities\Infra\Patch');
        
    }
    
    
    public function voicePanels()
    {
        
        return $this->hasMany('Infra\Entities\Infra\VoicePanel');
        
    }


}
