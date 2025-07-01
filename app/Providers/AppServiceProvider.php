<?php

namespace App\Providers;
use App\Services\InvoiceService;
use App\Services\Impl\InvoiceServiceImpl;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(InvoiceService::class, InvoiceServiceImpl::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
