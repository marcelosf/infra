<?php

namespace Infra\Listeners;

use Infra\Entities\Devices\SwitchPorts;
use Infra\Events\SwitchCreated;

class CreateSwitchPorts
{

    private $switchPorts;


    public function __construct(SwitchPorts $switchPorts)
    {

        $this->switchPorts = $switchPorts;

    }


    public function handle(SwitchCreated $event)
    {

        $this->createSwitchPorts($event->switch);

    }

    private function createSwitchPorts ($switch)
    {

        $numberOfPorts = $switch->getAttribute('num_ports');

        $switchId = $switch->getAttribute('id');

        for ($port = 1; $port <= $numberOfPorts; $port ++) {

            $this->switchPorts->create([

                'port' => $port,

                'is_poe' => true,

                'poe_status' => false,

                'vlan' => null,

                'switch_id' => $switchId,

                'ppanel_id' => null

            ]);

        }

    }
}
