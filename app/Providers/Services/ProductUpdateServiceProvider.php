<?php

namespace App\Providers\Services;

use App\Services\Interfaces\ProductUpdateServiceInterface;
use App\Services\ProductUpdateService;
use Illuminate\Support\ServiceProvider;

class ProductUpdateServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            ProductUpdateServiceInterface::class,
            ProductUpdateService::class
        );
    }

    /**
     * @return string[]
     */
    public function provides()
    {
        return [
            ProductUpdateServiceInterface::class,
        ];
    }
}
