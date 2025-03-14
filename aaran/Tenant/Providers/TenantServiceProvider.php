<?php

namespace Aaran\Tenant\Providers;

use Aaran\Tenant\Services\TenantService;
use Illuminate\Support\ServiceProvider;

class TenantServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(TenantService::class, function () {
            return new TenantService();
        });
    }

    public function boot()
    {
        //
    }
}
