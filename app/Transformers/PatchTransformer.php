<?php

namespace Infra\Transformers;

use League\Fractal\TransformerAbstract;
use Infra\Entities\Infra\Patch;

/**
 * Class PatchTransformer.
 *
 * @package namespace Infra\Transformers;
 */
class PatchTransformer extends TransformerAbstract
{

    public function transform(Patch $model)
    {

        return [

            'id'                        => $model->id,
            'build'                     => $model->local->build,
            'floor'                     => $model->local->floor,
            'room'                      => $model->local->local,
            'patchPort'                 => $model->reference,
            'status'                    => $this->getPatchStatus($model),
            'switchHostname'            => $model->switchPort ? $model->switchPort->dswitch->hostname : '',
            'switchIP'                  => $model->switchPort ? $model->switchPort->dswitch->ip : '',
            'switchIdentification'      => $model->switchPort ? $model->switchPort->dswitch->stack : '',
            'switchPort'                => $model->switchPort ? $model->switchPort->port : '',
            'service'                   => $model->resource,
            'switchVlan'                => $model->switchPort ? $model->switchPort->vlan : '',
            'rackLocation'              => $model->rack->local->local,
            'rack_id'                   => $model->rack_id

        ];

    }

    private function getPatchStatus (Patch $model)
    {

        if ($model->switchPort || $model->voicePort) {

            return 'A';

        }

        return 'N';

    }

}
