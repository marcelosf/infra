<?php

namespace Infra\Transformers;

use League\Fractal\TransformerAbstract;
use Infra\Entities\PatchList\PatchList;

/**
 * Class PatchListTransformer.
 *
 * @package namespace Infra\Transformers;
 */
class PatchListTransformer extends TransformerAbstract
{


    public function transform(PatchList $model)
    {

        return [

            'build'                     => $model->build,
            'floor'                     => $model->floor,
            'room'                      => $model->local,
            'patchPort'                 => $model->patchPort,
            'status'                    => $this->getPatchStatus($model),
            'switchHostname'            => $model->switchHostname,
            'switchIP'                  => $model->switchPortIp,
            'switchIdentification'      => $model->switch,
            'switchPort'                => $model->switchPort,
            'service'                   => $model->resource,
            'switchVlan'                => $model->switchPortVlan,
            'rackLocation'              => $model->rack,

        ];

    }


    private function getPatchStatus (PatchList $model)
    {

        if ($model->switchPort || $model->voicePort) {

            return 'A';

        }

        return 'N';

    }

}
