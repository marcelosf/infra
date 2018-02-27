<?php

namespace Infra\Entities\Devices;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Stack.
 *
 * @package namespace Infra\Entities\Devices;
 */
class Stack extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'hostname',
        'rack_id'
    ];


    /**
     * Rack relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rack()
    {

        return $this->belongsTo('Infra\Entities\Infra\Rack');

    }

    /**
     * Switches relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function switches()
    {

        return $this->hasMany('Infra\Entities\Devices\Switches');

    }

}
