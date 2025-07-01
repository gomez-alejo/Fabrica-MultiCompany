<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Impl\SupplierServiceImpl;
use App\Services\SupplierService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //supplier de proveedores 
     $this->app->bind(SupplierService::class,  SupplierServiceImpl::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
