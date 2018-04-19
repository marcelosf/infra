<?php

namespace Infra\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Infra\Entities\Infra\VoicePanel;

class VoicepanelCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

   
    public $voicePanel;

    public function __construct(VoicePanel $voicePanel)
    {
        
        $this->voicePanel = $voicePanel;

    }

    
    public function broadcastOn()
    {

        return new PrivateChannel('channel-name');

    }
}
