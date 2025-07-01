<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Impl\BranchServiceImpl;
use App\Services\BranchService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BranchService::class, BranchServiceImpl::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        
    }
}
