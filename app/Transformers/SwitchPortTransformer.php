<?php

namespace Infra\Transformers;

use League\Fractal\TransformerAbstract;
use Infra\Entities\Devices\SwitchPorts;

/**
 * Class SwitchPortTransformer.
 *
 * @package namespace Infra\Transformers;
 */
class SwitchPortTransformer extends TransformerAbstract
{
    /**
     * Transform the SwitchPort entity.
     *
     * @param SwitchPorts $model
     * @return array
     */
    public function transform(SwitchPorts $model)
    {
        return [

            'id'         => (int) $model->id,
            'port'       => $model->port,
            'is_poe'     => $model->is_poe,
            'poe_status' => $model->poe_status,
            'vlan'       => $model->vlan,
            'switch_id'  => $model->switch_id,
            'ppanel_id'  => $model->ppanel_id,
            'ppanel'     => $this->getPatchReference($model),

        ];
    }

    private function getPatchReference ($model)
    {

        return $model->patch ? $model->patch->reference : null;

    }


}
