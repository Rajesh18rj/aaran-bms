<?php

namespace Aaran\Web\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Volt\Volt;

class WebServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->register(WebRouteServiceProvider::class);
    }

    public function boot(): void
    {
        Volt::mount([
            base_path("aaran/Web/Livewire"),
            base_path("aaran/Web/Livewire")
        ]);

        $this->loadViewsFrom(__DIR__ . '/../Livewire', 'web');

    }
}
