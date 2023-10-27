<?php

namespace App\Repositories\Interfaces;

interface OfferRepositoryInterface
{
    public function getOffersById(array $offerIds);

    public function updateOffers(array $offerIds, array $updateData);

    public function productStatusCompare(string $status);

    public function sendMarketplaceOfferUpdate(array $requestData);
}
