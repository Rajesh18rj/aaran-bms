<?php

namespace Aaran\Docs\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Aaran\Web\Livewire\Dashboard;

class DocsServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'Docs';
    protected string $moduleNameLower = 'docs';

    public function register(): void
    {
        $this->app->register(DocsRouteServiceProvider::class);
        $this->loadConfigs();
        $this->loadViews();
    }

    public function boot(): void
    {
        $this->loadMigrations();

        Livewire::component('docs::index', Dashboard\Index::class);
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
