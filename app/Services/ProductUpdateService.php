<?php

namespace App\Services;

use App\Events\ProductUpdateReceived;
use App\Services\Interfaces\ProductUpdateServiceInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ProductUpdateService implements ProductUpdateServiceInterface
{
    /**
     * Constante que armazena a URL de consulta para validação de produtos
     */
    const PRODUCT_VALIDATION_BASE_URL = 'https://demo8880419.mockable.io/products/';

    /**
     * Método responsável por realizar as ações de atualização de produto
     *
     * @param  array  $updateData Dados da requisição
     * @return bool
     */
    public function updateProduct(array $updateData)
    {
        $isValidProduct = $this->validateProduct($updateData['product_ref']);

        Log::channel('hubProductUpdate')->info(
            $isValidProduct
                ? 'Atualização de produto recebida. Dados: '.json_encode($updateData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
                : "Atualização de produto inválido recebida. (ref. {$updateData['product_ref']})"
        );

        if (! $isValidProduct) {
            return false;
        }

        event(new ProductUpdateReceived($updateData));

        return true;
    }

    /**
     * Método responsável por validar a existência de um produto a partir da referência
     *
     * @param  string  $productRef Referência do produto
     * @return bool
     */
    public function validateProduct(string $productRef)
    {
        $productValidationUrl = self::PRODUCT_VALIDATION_BASE_URL.$productRef;

        $responseStatus = Http::acceptJson()
            ->get($productValidationUrl)
            ->status();

        return $responseStatus == Response::HTTP_OK;
    }
}
