<?php

namespace App\Providers\Services;

use App\Services\Interfaces\ProductServiceInterface;
use App\Services\ProductService;
use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            ProductServiceInterface::class,
            ProductService::class
        );
    }

    /**
     * @return string[]
     */
    public function provides()
    {
        return [
            ProductServiceInterface::class,
        ];
    }
}
