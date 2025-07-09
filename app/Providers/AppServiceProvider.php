<?php

namespace App\Providers;

use App\Models\Warehouse;
use App\Services\Impl\WarehouseServiceImpl;
use App\Services\WarehouseService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(WarehouseService::class,WarehouseServiceImpl::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
