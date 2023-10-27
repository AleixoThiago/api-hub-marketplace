<?php

namespace App\Services\Interfaces;

use App\Models\Product;

interface OfferServiceInterface
{
    public function update(array $data);
    public function getOfferUpdateData(object $product);
    public function sendMarketplaceOfferUpdate(array $offerIds);
    public function getRequestData(array $offer);
}
