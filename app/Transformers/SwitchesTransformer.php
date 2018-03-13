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

            'number' => $model->number,

            'numports' => $model->numports,

            'rack_id' => $model->rack_id,

            'created_at' => $model->created_at

        ];

    }
}
