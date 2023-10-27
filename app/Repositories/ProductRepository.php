<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\Log;

class ProductRepository implements ProductRepositoryInterface
{
    /**
     * Método construtor da classe
     *
     * @param  Product  $product Instância de Product
     * @return void
     */
    public function __construct(
        private readonly Product $product
    ) {
    }

    /**
     * Método reponsável por retornar um produto a partir de seu ID
     *
     * @param  int  $productId ID do produto
     * @return ?object
     */
    public function getProductById(int $productId): ?object
    {
        return $this->product::find($productId);
    }

    /**
     * Método reponsável por atualizar um produto a partir de seu referência
     *
     * @param  string  $reference Referência do produto
     * @param  string  $field     Campo para ataulização
     * @param  float|string  $value     Valor da atualização
     * @return ?int
     */
    public function updateProductByReference(string $reference, string $field, float|string $value)
    {
        $product = $this->product->where('reference', $reference)->first();

        Log::channel('hubProductUpdate')
            ->info("Produto `{$product->title}` atualizado, `{$field}` de `{$product->$field}` para `{$value}`.");

        $product->$field = $value;
        $product->save();

        return $product->id;
    }
}
