<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProductUpdateReceived
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $updateData;

    /**
     * Construtor do evento de recebimento de webhook de atualização de produto
     *
     * @param  array  $updateData Dados de atualização
     * @return void
     */
    public function __construct(array $updateData)
    {
        $this->updateData = $updateData;
    }
}
