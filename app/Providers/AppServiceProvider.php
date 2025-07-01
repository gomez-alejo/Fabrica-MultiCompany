<?php

namespace App\Providers;

use App\Services\Impl\InvoiceServiceProductImpl;
use App\Services\Impl\ProductRequestServiceImpl;
use App\Services\InvoiceProductService;
use App\Services\ProductRequestService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(InvoiceProductService::class, InvoiceServiceProductImpl::class);
        $this->app->bind(ProductRequestService::class, ProductRequestServiceImpl::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
