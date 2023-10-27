<?php

namespace App\Providers\Repositories;

use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\ProductRepository;
use Illuminate\Support\ServiceProvider;

class ProductRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            ProductRepositoryInterface::class,
            ProductRepository::class
        );
    }

    /**
     * @return string[]
     */
    public function provides()
    {
        return [
            ProductRepositoryInterface::class,
        ];
    }
}
