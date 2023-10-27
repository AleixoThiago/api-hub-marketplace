<?php

namespace App\Repositories\Interfaces;

interface ProductRepositoryInterface
{
    public function getProductById(int $productId): ?object;

    public function updateProductByReference(string $reference, string $field, float|string $value);
}
