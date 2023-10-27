<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProductUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $updateData;

    /**
     * Construtor do evento de produto atualizado
     *
     * @param  array $updateData Dados da atualização
     * @return void
     */
    public function __construct(array $updateData)
    {
        $this->updateData = $updateData;
    }
}
