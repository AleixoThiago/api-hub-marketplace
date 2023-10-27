<?php

namespace App\Services\Interfaces;

interface ProductServiceInterface
{
    public function getProductById(int $id);
    public function update(array &$data);
}
