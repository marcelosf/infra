<?php

namespace Infra\Entities\Local;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;


class Local extends Model implements Transformable
{
    
    use TransformableTrait;

    
    protected $fillable = [
        
        'build',
        'floor',
        'local',
        
    ];
    
    
    protected $table = 'local';
    
    
    public function racks()
    {
        
        return $this->hasMany('Infra\Entities\Infra\Rack');
        
    }
    
    
    public function patchs()
    {
        
        return $this->hasMany('Infra\Entities\Infra\Patch');
        
    }


}
