<?php

namespace App\Repositories;

use App\Models\Offer;
use App\Repositories\Interfaces\OfferRepositoryInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OfferRepository implements OfferRepositoryInterface
{
    /**
     * Constante que armazena a URL de notificação do marketplace
     */
    const MARKETPLACE_NOTIFICATION_URL = 'https://demo8880419.mockable.io/webhook';

    /**
     * Método construtor da classe
     *
     * @param  Offer  $offer Instância de Offer
     * @return void
     */
    public function __construct(
        private readonly Offer $offer
    ) {
    }

    /**
     * Método responsável por retornar ofertas com base em um array de IDs
     *
     * @param  array  $offerIds IDs das ofertas
     * @return array
     */
    public function getOffersById(array $offerIds)
    {
        return $this->offer->whereIn('id', $offerIds)->get()->toArray();
    }

    /**
     * Método responsável por atualizar ofertas em massa
     *
     * @param  array  $offerIds   IDs das ofertas
     * @param  array  $updateData Dados de atualização
     * @return void
     */
    public function updateOffers(array $offerIds, array $updateData)
    {
        $this->offer->whereIn('id', $offerIds)->update($updateData);

        Log::channel('hubOfferUpdate')
            ->info('Ofertas ('.implode(',', $offerIds).') atualizadas. Dados: '.json_encode($updateData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    }

    /**
     * Método responsável por comparar e converter o valor do status do produto para status da oferta
     *
     * @param  string  $status Status a ser comparado
     * @return string
     */
    public function productStatusCompare(string $status)
    {
        $statusCompareArray = [
            'active' => 'active',
            'inactive' => 'paused',
        ];

        return $statusCompareArray[$status];
    }

    /**
     * Método responsável por enviar uma requisição de atualização ao marketplace
     *
     * @param  array  $requestData dados da requisição
     * @return void
     */
    public function sendMarketplaceOfferUpdate(array $requestData)
    {
        $response = Http::post(self::MARKETPLACE_NOTIFICATION_URL, $requestData);

        Log::channel('hubOfferUpdate')
            ->info("Notificação enviada ao marketplace (reponse {$response->status()}). Request: ".json_encode($requestData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    }
}
