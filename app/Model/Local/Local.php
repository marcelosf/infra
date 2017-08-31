<?php

namespace Infra\Model\Local;

use Illuminate\Database\Eloquent\Model;

class Local extends Model
{

    protected $fillable = [

        'build',
        'floor',
        'local',

    ];

    protected $table = 'local';

}
