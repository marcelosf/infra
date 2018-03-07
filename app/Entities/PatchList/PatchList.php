<?php

namespace Infra\Entities\PatchList;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;


class PatchList extends Model implements Transformable
{

    use TransformableTrait;


    protected $fillable = [

        'build',
        'floor',
        'local',
        'patchPort',
        'switchHostName',
        'switchPortIp',
        'switch',
        'resource',
        'switchPotVlan',
        'switchPot',
        'rackLocal',
        'rack',

    ];


    protected $table = 'patchList';

}
