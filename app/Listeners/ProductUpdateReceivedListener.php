<?php

namespace App\Listeners;

use App\Events\ProductUpdateReceived;
use App\Jobs\ProcessProductUpdate;
use App\Services\Interfaces\ProductServiceInterface;

class ProductUpdateReceivedListener
{
    public function __construct(
        private readonly ProductServiceInterface $productService
    ) {
    }

    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle(ProductUpdateReceived $event)
    {
        // ENFILEIRA O JOB DE PROCESSAMENTO DE ATUALIZAÇÃO DE PRODUTO NO HUB
        ProcessProductUpdate::dispatch($event->updateData, $this->productService);
    }
}
