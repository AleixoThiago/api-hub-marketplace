<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OfferUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $offerIds;

    /**
     * Construtor do evento de oferta atualizada
     *
     * @param  array $offerIds IDs das ofertas
     * @return void
     */
    public function __construct(array $offerIds)
    {
        $this->offerIds = $offerIds;
    }
}
