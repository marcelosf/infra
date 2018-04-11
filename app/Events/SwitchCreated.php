<?php

namespace Infra\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Infra\Entities\Devices\Switches;

class SwitchCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $switch;

    public function __construct(Switches $switch)
    {

        $this->switch = $switch;

    }


    public function broadcastOn()
    {

        return new PrivateChannel('channel-name');

    }
}
