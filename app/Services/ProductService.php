<?php

namespace App\Services;

use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Services\Interfaces\ProductServiceInterface;

class ProductService implements ProductServiceInterface
{
    /**
     * Método construtor da classe
     *
     * @param  ProductRepositoryInterface  $productRepository Instância de ProductRepositoryInterface
     */
    public function __construct(
        private readonly ProductRepositoryInterface $productRepository
    ) {
    }

    /**
     * Método responsável por buscar um produto pelo seu ID
     *
     * @param  int  $id ID do produto
     * @return null|object
     */
    public function getProductById(int $id)
    {
        return $this->productRepository->getProductById($id);
    }

    /**
     * Método responsável por chamar a atualização de um produto
     *
     * @param  array  $data Dados para atualização
     * @return void
     */
    public function update(array &$data)
    {
        $scope = $data['scope'];
        $scopeCompare = [
            'price' => 'price',
            'status' => 'status',
            'stock' => 'quantity',
        ];

        $updateField = $scopeCompare[$scope];
        $updateValue = $data[$scope];

        $productId = $this->productRepository->updateProductByReference($data['product_ref'], $updateField, $updateValue);

        $data['product_id'] = $productId;
    }
}
