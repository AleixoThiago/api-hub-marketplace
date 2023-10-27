<?php

namespace App\Listeners;

use App\Events\OfferUpdated;
use App\Jobs\SendMarketplaceWebhook;
use App\Services\Interfaces\OfferServiceInterface;

class OfferUpdatedListener
{
    public function __construct(
        private readonly OfferServiceInterface $offerService
    ) {
    }

    /**
     * Handle the event.
     *
     * @param  Offer $event
     * @return void
     */
    public function handle(OfferUpdated $event)
    {
        // ENFILEIRA O JOB DE ENVIO AO MARKETPLACE
        SendMarketplaceWebhook::dispatch($event->offerIds, $this->offerService);
    }
}
