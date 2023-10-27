<?php

namespace App\Services;

use App\Events\OfferUpdated;
use App\Models\Product;
use App\Repositories\Interfaces\OfferRepositoryInterface;
use App\Services\Interfaces\OfferServiceInterface;
use App\Services\Interfaces\ProductServiceInterface;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Log;

class OfferService implements OfferServiceInterface
{
    /**
     * Método construtor da classe
     *
     * @param  OfferRepositoryInterface  $offerRepository Instância de OfferRepositoryInterface
     */
    public function __construct(
        private readonly OfferRepositoryInterface $offerRepository,
        private readonly ProductServiceInterface $productService
    ) {
    }

    /**
     * Método responsável por chamar a atualização de ofertas
     *
     * @param  array $data Dados da requisição
     * @return void
     */
    public function update(array $data)
    {
        if (!isset($data['product_id'])) return;

        $product       = $this->productService->getProductById($data['product_id']);
        $productOffers = $product->offers;

        $updateIds = [];
        foreach ($productOffers as $offer) {
            $updateIds[] = $offer->id;
        }

        if (empty($updateIds)) {
            Log::channel('hubOfferUpdate')
                ->info("O produto de ID {$product->id} não possui vínculo com ofertas no marketplace.");
            return;
        }

        $updateData = $this->getOfferUpdateData($product);
        $this->offerRepository->updateOffers($updateIds, $updateData);
        event(new OfferUpdated($updateIds));
    }

    /**
     * Método responsável por chamar a atualização de ofertas
     *
     * @param  object $product Dados do produto
     * @return array
     */
    public function getOfferUpdateData(object $product)
    {
        return [
            'status'         => $this->offerRepository->productStatusCompare($product->status),
            'price'          => $product->price,
            'sale_price'     => $product->promotional_price,
            'sale_starts_on' => $product->promotion_starts_on,
            'sale_ends_on'   => $product->promotion_ends_on,
            'stock'          => $product->quantity,
        ];
    }

    /**
     * Método responsável por chamar o envio de atualização de oferta ao marketplace
     *
     * @param  array $offerIds IDs das ofertas
     * @return void
     */
    public function sendMarketplaceOfferUpdate(array $offerIds)
    {
        $offers = $this->offerRepository->getOffersById($offerIds);

        foreach ($offers as $offer) {
            $requestData = $this->getRequestData($offer);
            $this->offerRepository->sendMarketplaceOfferUpdate($requestData);
        }
    }

    /**
     * Método responsável por retornar os dados para a request
     *
     * @param  array $offer Dados de uma oferta
     * @return array
     */
    public function getRequestData(array $offer)
    {
        $requestData = $offer;
        $requestData['offer_ref'] = $offer['reference'];
        unset($requestData['id'], $requestData['reference']);

        return $requestData;
    }
}
