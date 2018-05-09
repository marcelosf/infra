<?php

namespace Infra\Transformers;

use League\Fractal\TransformerAbstract;
use Infra\Entities\Devices\Switches;

/**
 * Class SwitchesTransformer.
 *
 * @package namespace Infra\Transformers;
 */
class SwitchesTransformer extends TransformerAbstract
{

    public function transform(Switches $model)
    {

        return [

            'ip' => $model->ip,

            'num_ports' => $model->num_ports,

            'brand' => $model->brand,

            'name' => $model->hostname,

            'stack' => $model->stack,

            'numports' => $model->num_ports,

            'created_at' => $model->created_at

        ];

    }
}
