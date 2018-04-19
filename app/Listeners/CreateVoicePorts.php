<?php

namespace Infra\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Infra\Entities\Infra\VoicePort;
use Infra\Events\VoicepanelCreated;

class CreateVoicePorts
{

    protected $voicePort;

    
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(VoicePort $voicePort)
    {
        
        $this->voicePort = $voicePort;

    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(VoicepanelCreated $event)
    {

        $this->createVoicePort($event->voicePanel);

    }


    private function createVoicePort ($voicePanel)
    {

        $numberOfPorts = $voicePanel->getAttribute('numports');

        $voicePanelId = $voicePanel->getAttribute('id');

        for ($port= 1; $port <= $numberOfPorts; $port ++)
        {

            printf("Creating port: %s", $port);

            $this->voicePort->create([

                'number'        => $port,

                'voicepanel_id' => $voicePanelId,

            ]);

        }

    }

}
