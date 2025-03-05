<?php

namespace Aaran;

use Illuminate\Support\ServiceProvider;

class AaranServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Register each provider from the $providers array.
        foreach ($this->providers as $provider) {
            $this->app->register($provider);
        }
    }

    protected array $providers = [
        \Aaran\Web\Providers\WebServiceProvider::class,
        \Aaran\Auth\Providers\AuthServiceProvider::class,
        \Aaran\Setup\Providers\SetupServiceProvider::class,
    ];
}
