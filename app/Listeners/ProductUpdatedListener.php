<?php

namespace App\Listeners;

use App\Events\ProductUpdated;
use App\Jobs\ProcessOfferUpdate;
use App\Services\Interfaces\OfferServiceInterface;

class ProductUpdatedListener
{
    public function __construct(
        private readonly OfferServiceInterface $offerService
    ) {
    }

    /**
     * Handle the event.
     *
     * @param  ProductUpdateReceived $event
     * @return void
     */
    public function handle(ProductUpdated $event)
    {
        // ENFILEIRA O JOB DE PROCESSAMENTO DE ATUALIZAÇÃO DE OFERTA NO HUB
        ProcessOfferUpdate::dispatch($event->updateData, $this->offerService);
    }
}
