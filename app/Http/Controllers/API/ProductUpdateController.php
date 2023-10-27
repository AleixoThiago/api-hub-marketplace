<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductUpdateRequest;
use App\Services\Interfaces\ProductUpdateServiceInterface;
use Illuminate\Http\Response;

class ProductUpdateController extends Controller
{
    /**
     * Método construtor da classe
     *
     * @param  ProductUpdateServiceInterface  $productUpdateService Instância de ProductUpdateService
     * @return void
     */
    public function __construct(
        private readonly ProductUpdateServiceInterface $productUpdateService
    ) {
    }

    /**
     * Método responsável por lidar com o recebimento (via webhook) de uma atualização de produto
     *
     * @param  ProductUpdateRequest  $request Instância de ProductUpdateRequest
     * @return \Illuminate\Http\Response
     */
    public function handleProductUpdate(ProductUpdateRequest $request)
    {
        $updateData = $request->validated();

        $message = 'Atualização de produto recebida com sucesso.';
        $code = Response::HTTP_OK;
        if (! $this->productUpdateService->updateProduct($updateData)) {
            $message = 'Produto para atualização não encontrado.';
            $code = Response::HTTP_NOT_FOUND;
        }

        return response($message, $code);
    }
}
