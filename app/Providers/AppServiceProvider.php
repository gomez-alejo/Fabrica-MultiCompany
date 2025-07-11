<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\RequesttService;
use App\Services\Impl\RequesttServiceImpl;

class AppServiceProvider extends ServiceProvider
{
 /**
     * Register any application services.
     */
    public function register(): void
    {
        // Liga la interfaz RequesttService con RequesttServiceImpl
        $this->app->bind(RequesttService::class, RequesttServiceImpl::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
