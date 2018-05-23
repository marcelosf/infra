<?php

namespace Infra\Transformers;

use League\Fractal\TransformerAbstract;
use Infra\Entities\Devices\Stack;


class StackTransformer extends TransformerAbstract
{

    public function transform(Stack $model)
    {

        return [

            'id'                    => $model->id,
            'stack_hostname'        => $model->hostname,
            'rack_id'               => $model->rack_id,
            'switches'              => $model->switches,
            'created_at'            => $model->created_at,
            'updated_at'            => $model->updated_at

        ];

    }

}
