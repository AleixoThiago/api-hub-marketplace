<?php

namespace App\Services\Interfaces;

interface OfferServiceInterface
{
    public function update(array $data);

    public function getOfferUpdateData(object $product);

    public function sendMarketplaceOfferUpdate(array $offerIds);

    public function getRequestData(array $offer);
}
