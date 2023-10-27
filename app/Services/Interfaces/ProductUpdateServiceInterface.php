<?php

namespace App\Services\Interfaces;

interface ProductUpdateServiceInterface
{
    public function updateProduct(array $updateData);

    public function validateProduct(string $productRef);
}
