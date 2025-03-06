<?php

namespace Aaran\MasterGst\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

use Aaran\MasterGst\Livewire\Authenticate;

class MasterGstServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'MasterGst';
    protected string $moduleNameLower = 'master-gst';

    public function register(): void
    {
        $this->app->register(MasterGstRouteServiceProvider::class);
        $this->loadConfigs();
        $this->loadViews();
    }
    public function boot(): void
    {
        $this->loadMigrations();
//        $this->app->register(MasterGstRouteServiceProvider::class);

        Livewire::component('master-gst::authenticate', Authenticate::class);
    }

    protected function loadConfigs(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config.php', $this->moduleNameLower);
    }

    protected function loadViews(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../Livewire', $this->moduleNameLower);
    }

    protected function loadMigrations(): void
    {

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

}
